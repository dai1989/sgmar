<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;

use App\Http\Requests\VentasFormRequest;

use App\Venta;

use App\DetalleVenta;

use App\Presupuesto;

use App\Categoria;

use App\Models\Persona;

use App\DetallePresupuesto;

use DB;

use Carbon\Carbon;

use Response;

use Illuminate\Support\Collection;


class VentaController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {
    if ($request)
    {
      $query=trim($request->get('searchText'));
      $ventas=DB::table('venta as v')
      ->join('personas as p','v.persona_id','=','p.id')
      ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
      ->select('v.idventa','v.fecha_hora','p.nombre','p.tipo_documento','p.documento','p.id','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
      ->where('v.num_comprobante','LIKE','%'.$query.'%')
      ->orderBy('v.idventa','desc')
      ->groupBy('v.idventa','v.fecha_hora','p.nombre','p.tipo_documento','p.documento','p.id','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
      ->paginate(7);
      return view('venta.index',["ventas"=>$ventas,"searchText"=>$query]);

    }
  }
  public function create()
  {
    $personas=Persona::all();
    $productos = DB::table('productos as prod')
    ->join('detalle_ingreso as di', 'prod.idproducto', '=', 'di.idproducto' )
    ->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS producto'),'prod.idproducto', 'prod.stock','prod.precio_venta',DB::raw('avg(di.precio_venta) as precio_promedio'))
    ->where('prod.estado','=','Activo')
    ->where('prod.stock','>','0')
    ->groupBy('producto','prod.idproducto','prod.stock','prod.precio_venta')
    ->get();
    $ven= Venta::all()->last();
    if ($ven==null) {
      $ven='1';
      return view("venta.create",["personas"=>$personas,"productos"=>$productos, "ven"=>$ven]);
      }
      else
      {
        return view("venta.create",["personas"=>$personas,"productos"=>$productos, "ven"=>$ven]);
      }


  }

  public function store (VentasFormRequest $request)
  {


    $fecha= DB::table('venta as v')
    ->orderBy('idventa','desc')
    ->first();
    $mytime = Carbon::now('America/Argentina/Mendoza');
    $ventaact=$mytime->toDateString();

    $ultimoid= DB::table('presupuesto')
    ->orderBy('idpresupuesto','desc')
    ->first();
    $ultimodetalle= DB::table('detalle_presupuesto')
    ->orderBy('idpresupuesto','desc')
    ->first();

    if ($request->get('persona_id') == null) {
      $persona=new Persona;
      
      $persona->nombre=$request->get('nombre');
      $persona->apellido=$request->get('apellido');
      $persona->tipo_documento=$request->get('tipo_documento');
      $persona->documento=$request->get('documento');
      $persona->genero=$request->get('genero');
      $persona->fecha_nacimiento=$request->get('fecha_nacimiento');
     
      $persona->save();

      $ultimapersona = DB::table('personas')
      ->orderBy('id','desc')
      ->first();

      DB::beginTransaction();
      $venta=new Venta;
      $venta->persona_id=$ultimapersona->id;
      $venta->tipo_comprobante=$request->get('tipo_comprobante');
      $venta->num_comprobante=$request->get('num_comprobante');
      $venta->total_venta=$request->get('total_venta');
      $venta->idusuario=$request->get('idusuario');
      $venta->entrega=$request->entrega;

      $mytime = Carbon::now('America/Argentina/Mendoza');
      $venta->fecha_hora=$mytime->toDateTimeString();
      $venta->impuesto='21';
      $venta->estado='Sin Revisar';
      $venta->save();

      $idproducto = $request->get('idproducto');
      $cantidad = $request->get('cantidad');
      $descuento = $request->get('descuento');
      $precio_venta = $request->get('precio_venta');

      $cont = 0;

      while($cont < count($idproducto)){
        $detalle = new DetalleVenta();
        $detalle->idventa= $venta->idventa;
        $detalle->idproducto= $idproducto[$cont];
        $detalle->cantidad= $cantidad[$cont];
        $detalle->descuento= $descuento[$cont];
        $detalle->precio_venta= $precio_venta[$cont];
        $detalle->save();
        $cont=$cont+1;
      }
      DB::commit();
    }
    else {
      DB::beginTransaction();
      $venta=new Venta;
      $venta->persona_id=$request->get('persona_id');
      $venta->tipo_comprobante=$request->get('tipo_comprobante');
      $venta->num_comprobante=$request->get('num_comprobante');
      $venta->total_venta=$request->get('total_venta');
      $venta->idusuario=$request->get('idusuario');
      $venta->entrega=$request->entrega;

      $mytime = Carbon::now('America/Argentina/Mendoza');
      $venta->fecha_hora=$mytime->toDateTimeString();
      $venta->impuesto='21';
      $venta->estado='Sin Revisar';
      $venta->save();

      $idproducto = $request->get('idproducto');
      $cantidad = $request->get('cantidad');
      $descuento = $request->get('descuento');
      $precio_venta = $request->get('precio_venta');

      $cont = 0;

      while($cont < count($idproducto)){
        $detalle = new DetalleVenta();
        $detalle->idventa= $venta->idventa;
        $detalle->idproducto= $idproducto[$cont];
        $detalle->cantidad= $cantidad[$cont];
        $detalle->descuento= $descuento[$cont];
        $detalle->precio_venta= $precio_venta[$cont];
        $detalle->save();
        $cont=$cont+1;
      }
      DB::commit();
    }


    if (Presupuesto::exists()) {

      if ( $ventaact == $fecha->fecha_hora) {
        $totalpro = $ultimoid->total_venta + $request->get('total_venta');
        $venta=Presupuesto::findOrFail($ultimoid->idpresupuesto);
        $venta->total_venta=$totalpro;
        $venta->update();

        $idproducto = $request->get('idproducto');
        $cantidad = $request->get('cantidad');
        $descuento = $request->get('descuento');
        $precio_venta = $request->get('precio_venta');

        $cont = 0;

        while($cont < count($idproducto)){
          $detalle = new DetallePresupuesto();
          $detalle->idpresupuesto= $ultimoid->idpresupuesto;
          $detalle->idproducto= $idproducto[$cont];
          $detalle->cantidad= $cantidad[$cont];
          $detalle->descuento= $descuento[$cont];
          $detalle->precio_venta= $precio_venta[$cont];
          $detalle->save();
          $cont=$cont+1;
        }

      }
      else {

        DB::beginTransaction();
        $presupuesto=new Presupuesto;
        if ($request->get('persona_id') == null) {
          $presupuesto->persona_id=  $fecha->persona_id;
        }
        else {
          $presupuesto->persona_id=$request->get('persona_id');
        }
        $presupuesto->tipo_comprobante=$request->get('tipo_comprobante');

        $presupuesto->num_comprobante=$request->get('num_comprobante');
        $presupuesto->total_venta=$request->get('total_venta');
        $presupuesto->idusuario=$request->get('idusuario');

        $mytime = Carbon::now('America/Argentina/Mendoza');
        $presupuesto->fecha_hora=$mytime->toDateTimeString();
        $presupuesto->impuesto='21';
        $presupuesto->estado='Sin Revisar';
        $presupuesto->save();

        $idproducto = $request->get('idproducto');
        $cantidad = $request->get('cantidad');
        $descuento = $request->get('descuento');
        $precio_venta = $request->get('precio_venta');

        $cont = 0;

        while($cont < count($idproducto)){
          $detalle = new DetallePresupuesto();
          $detalle->idpresupuesto= $presupuesto->idpresupuesto;
          $detalle->idproducto= $idproducto[$cont];
          $detalle->cantidad= $cantidad[$cont];
          $detalle->descuento= $descuento[$cont];
          $detalle->precio_venta= $precio_venta[$cont];
          $detalle->save();
          $cont=$cont+1;
        }
        DB::commit();
      }
    }
    else {
    
      DB::beginTransaction();
      $presupuesto=new Presupuesto;
      if ($request->get('persona_id') == null) {
        $presupuesto->persona_id=  $fecha->persona_id;
      }
      else {
        $presupuesto->persona_id=$request->get('persona_id');
      }
      $presupuesto->tipo_comprobante=$request->get('tipo_comprobante');
      $presupuesto->num_comprobante=$request->get('num_comprobante');
      $presupuesto->total_venta=$request->get('total_venta');
      $presupuesto->idusuario=$request->get('idusuario');

      $mytime = Carbon::now('America/Argentina/Mendoza');
      $presupuesto->fecha_hora=$mytime->toDateTimeString();
      $presupuesto->impuesto='21';
      $presupuesto->estado='Sin Revisar';
      $presupuesto->save();

      $idproducto = $request->get('idproducto');
      $cantidad = $request->get('cantidad');
      $descuento = $request->get('descuento');
      $precio_venta = $request->get('precio_venta');

      $cont = 0;

      while($cont < count($idproducto)){
        $detalle = new DetallePresupuesto();
        $detalle->idpresupuesto= $presupuesto->idpresupuesto;
        $detalle->idproducto= $idproducto[$cont];
        $detalle->cantidad= $cantidad[$cont];
        $detalle->descuento= $descuento[$cont];
        $detalle->precio_venta= $precio_venta[$cont];
        $detalle->save();
        $cont=$cont+1;
      }
      DB::commit();

    }
    $ven= Venta::all()->last();
    flash('Su venta, del día '.$ven->fecha_hora=$mytime->format('d-m-Y').' ha sido creada correctamente')->important();

    return Redirect::to('venta');
  }

  public function show($id)
  {
    $venta=DB::table('venta as v')
    ->join('personas as p','v.persona_id','=','p.id')
    ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
    ->select('v.idventa','v.entrega','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario')
    ->groupBy('v.idventa','v.entrega','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario')
    ->where('v.idventa','=',$id)
    ->first();
    //dd($venta);
    $detalles=DB::table('detalle_venta as d')
    ->join('productos as prod','d.idproducto','=','prod.idproducto')
    ->select('prod.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta')
    ->where('d.idventa','=',$id)
    ->get();
    $usuario=DB::table('users')
    ->where('id','=',$venta->idusuario)
    ->first();
    return view("venta.show",["venta"=>$venta,"detalles"=>$detalles,"usuario"=>$usuario]);

  }

  public function ticke($id)
  {

    $venta=DB::table('venta as v')
    ->join('personas as p','v.persona_id','=','p.id')
    ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
    ->select('v.idventa','v.entrega','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario')
    ->groupBy('v.idventa','v.entrega','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario')
    ->where('v.idventa','=',$id)
    ->first();
    // dd($venta);
    $detalles=DB::table('detalle_venta as d')
    ->join('productos as prod','d.idproducto','=','prod.idproducto')
    ->select('prod.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta')
    ->where('d.idventa','=',$id)
    ->get();
    $usuario=DB::table('users')
    ->where('id','=',$venta->idusuario)
    ->first();
    return view("venta.tickes",["venta"=>$venta,"detalles"=>$detalles,"usuario"=>$usuario]);

  }
   public function pdf(Request $request,$id){
         $venta = Venta::join('personas','venta.persona_id','=','personas.id')
        ->join('users','venta.user_id','=','users.idusuario')
        ->select('venta.idventa','venta.tipo_comprobante',
        'venta.num_comprobante','venta.fecha_hora','venta.impuesto','venta.total_venta','venta.entrega',
        'venta.estado','personas.nombre','personas.apellido','personas.documento','personas.tipo_documento','users.name')
        ->where('venta.id','=',$id)
        ->orderBy('venta.id','desc')->take(1)->get();

        $detalles = DetalleVenta::join('productos','detalles_ventas.id_producto','=','productos.id')
        ->select('detalles_ventas.cantidad','detalles_ventas.precio_venta','detalles_ventas.descuento',
        'productos.descripcion as producto')
        ->where('detalles_ventas.id_venta','=',$id)
        ->orderBy('detalles_ventas.id','desc')->get();

        $factura_name= sprintf('venta-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('venta.pdf',['venta'=>$venta,'detalles'=>$detalles]);
        return $pdf->download($factura_name);  
      }

  public function destroy($id)
  {
    $venta=Venta::findOrFail($id);
    $venta->Estado='Revisada';
    $venta->update();
    $mytime = Carbon::now();
    flash('Su venta, del día '.date("d-m-Y", strtotime($venta->fecha_hora)).' ha sido dada como revisada correctamente')->success()->important();
    return Redirect::to('venta');
  }
}
