<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateVentaRequest;
use App\DataTables\VentaDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Persona;

use App\Models\DetallePresupuesto;
use App\Models\DetalleVenta;
use App\User;
use App\Presupuesto;
use App\Models\TipoPago;
use App\Models\TipoFactura;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Flash;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
class VentaController extends Controller
{
    
    //contructor
    public function __construct()
    {
        $this -> middleware('auth');
    }

    //index 
     public function index(VentaDataTable $ventaDataTable)
    {
        return $ventaDataTable->render('venta.index');
    }

    //create (muestra la vista de crear)
    public function create() 
    {
       $idventa=DB::table('ventas')->max('id')+1;
       $user_list = User::all();
       $tipofactura_list = TipoFactura::all();
       $tipopago_list = TipoPago::all();
       $personas = Persona::all();
       $productos = DB::table('productos as prod')
    ->join('detalles_ingresos as di', 'prod.id', '=', 'di.id_producto' )
    ->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS producto'),'prod.id', 'prod.stock','prod.precio_venta',DB::raw('avg(di.precio_venta) as precio_promedio'))
    ->where('prod.estado','=','Activo')
    ->where('prod.stock','>','0')
    ->groupBy('producto','prod.id','prod.stock','prod.precio_venta')
    ->get();
    $ven= Venta::all()->last();
    if ($ven==null) {
      $ven='1';
      return view("venta.create",["personas"=>$personas,"productos"=>$productos, "ven"=>$ven,'user_list' =>$user_list,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list,'idventa'=>$idventa]);
      }
      else
      {
        return view("venta.create",["personas"=>$personas,"productos"=>$productos, "ven"=>$ven,'user_list' =>$user_list,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list,'idventa'=>$idventa]);
      }

    }

    

    //store(insertar un registro)
    public function store(CreateVentaRequest $request)
   {


    $fecha= DB::table('ventas as v')
    ->orderBy('id','desc')
    ->first();
    $mytime = Carbon::now('America/Argentina/Mendoza');
    $ventaact=$mytime->toDateString();

    $ultimoid= DB::table('presupuestos')
    ->orderBy('id','desc')
    ->first();
    $ultimodetalle= DB::table('presupuesto_detalles')
    ->orderBy('presupuesto_id','desc')
    ->first();

    if ($request->get('persona_id') == null) {
      $persona=new Persona;
      
      $persona->nombre=$request->get('nombre');
      $persona->apellido=$request->get('apellido');
      $persona->tipo_documento=$request->get('tipo_documento');
      $persona->documento=$request->get('documento');
      $persona->fecha_nacimiento=$request->get('fecha_nacimiento');
      $persona->genero=$request->get('genero');
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
      $venta->user_id=$request->get('user_id');
      $venta ->tipofactura_id = $request -> get('tipofactura_id');
      $venta ->tipopago_id = $request -> get('tipopago_id');
      $venta ->tipo_comprobante = $request -> get('tipo_comprobante');
      $venta->entrega=$request->entrega;

      $mytime = Carbon::now('America/Argentina/Mendoza');
      $venta->fecha_hora=$mytime->toDateTimeString();
      $venta->impuesto='0.21';
      $venta->estado='Efectuada';
      $venta->save();

      $id_producto = $request->get('id_producto');
      $cantidad = $request->get('cantidad');
      $descuento = $request->get('descuento');
      $precio_venta = $request->get('precio_venta');

      $cont = 0;

      while($cont < count($id_producto)){
        $detalle = new DetalleVenta();
        $detalle->id_venta= $venta->id;
        $detalle->id_producto= $id_producto[$cont];
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
       $venta->user_id=$request->get('user_id');
      $venta ->tipofactura_id = $request -> get('tipofactura_id');
      $venta ->tipopago_id = $request -> get('tipopago_id');
      $venta ->tipo_comprobante = $request -> get('tipo_comprobante');
      $venta->entrega=$request->entrega;

      $mytime = Carbon::now('America/Argentina/Mendoza');
      $venta->fecha_hora=$mytime->toDateTimeString();
      $venta->impuesto='0.21';
      $venta->estado='Efectuada';
      $venta->save();

      $id_producto = $request->get('id_producto');
      $cantidad = $request->get('cantidad');
      $descuento = $request->get('descuento');
      $precio_venta = $request->get('precio_venta');

      $cont = 0;

      while($cont < count($id_producto)){
        $detalle = new DetalleVenta();
        $detalle->id_venta= $venta->id;
        $detalle->id_producto= $id_producto[$cont];
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
        $venta=Presupuesto::findOrFail($ultimoid->id);
        $venta->total_venta=$totalpro;
        $venta->update();

        $producto_id = $request->get('producto_id');
        $cantidad = $request->get('cantidad');
        $descuento = $request->get('descuento');
        $precio_venta = $request->get('precio_venta');

        $cont = 0;

        while($cont < count($producto_id)){
          $detalle = new DetallePresupuesto();
          $detalle->presupuesto_id= $ultimoid->id;
          $detalle->producto_id= $producto_id[$cont];
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
        $presupuesto->user_id=$request->get('user_id');

        $mytime = Carbon::now('America/Argentina/Mendoza');
        $presupuesto->fecha_hora=$mytime->toDateTimeString();
        $presupuesto->impuesto='0.21';
        $presupuesto->estado='Efectuado';
        $presupuesto->save();

        $producto_id = $request->get('producto_id');
        $cantidad = $request->get('cantidad');
        $descuento = $request->get('descuento');
        $precio_venta = $request->get('precio_venta');

        $cont = 0;

        while($cont < count($producto_id)){
          $detalle = new DetallePresupuesto();
          $detalle->presupuesto_id= $presupuesto->id;
          $detalle->producto_id= $producto_id[$cont];
          $detalle->cantidad= $cantidad[$cont];
          $detalle->descuento= $descuento[$cont];
          $detalle->precio_venta= $precio_venta[$cont];
          $detalle->save();
          $cont=$cont+1;
        }
        DB::commit();
      }
    }
   
    $ven= Venta::all()->last();
    flash('Su venta, del día '.$ven->fecha_hora=$mytime->format('d-m-Y').' ha sido creada correctamente')->important();

    return Redirect::to('venta');
  }
    //show
    public function show($id)
  {
    $venta=DB::table('ventas as v')
    ->join('personas as p','v.persona_id','=','p.id')
    ->join('detalles_ventas as dv','v.id','=','dv.id_venta')
    ->select('v.id','v.entrega','v.fecha_hora','p.nombre','p.apellido','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','user_id')
    ->groupBy('v.id','v.entrega','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','user_id')
    ->where('v.id','=',$id)
    ->first();
    //dd($venta);
    $detalles=DB::table('detalles_ventas as dv')
    ->join('productos as prod','dv.id_producto','=','prod.id')
    ->select('prod.descripcion as producto','dv.created_at','dv.cantidad','dv.descuento','dv.precio_venta')
    ->where('dv.id_venta','=',$id)
    ->get();
    
    return view("venta.show",["venta"=>$venta,"detalles"=>$detalles]);

  }


        public function pdf(Request $request,$id){
         $venta = Venta::join('personas','ventas.persona_id','=','personas.id')
        ->join('users','ventas.user_id','=','users.id')
        ->select('ventas.id','ventas.tipo_comprobante',
        'ventas.num_comprobante','ventas.fecha_hora','ventas.impuesto','ventas.total_venta','ventas.entrega',
        'ventas.estado','personas.nombre','personas.apellido','personas.documento','personas.tipo_documento','users.name')
        ->where('ventas.id','=',$id)
        ->orderBy('ventas.id','desc')->take(1)->get();

        $detalles = DetalleVenta::join('productos','detalles_ventas.id_producto','=','productos.id')
        ->select('detalles_ventas.cantidad','detalles_ventas.precio_venta','detalles_ventas.descuento',
        'productos.descripcion as producto')
        ->where('detalles_ventas.id_venta','=',$id)
        ->orderBy('detalles_ventas.id','desc')->get();

        $factura_name= sprintf('venta-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('venta.pdf',['venta'=>$venta,'detalles'=>$detalles]);
        return $pdf->download($factura_name);  
      }

    //update (actualizar un registro)
    

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
  {
    $venta=Venta::findOrFail($id);
    $venta->Estado='Cancelada';
    $venta->update();
    $mytime = Carbon::now();
    flash('Su venta, del día '.date("d-m-Y", strtotime($venta->fecha_hora)).' ha sido dada como cancelada correctamente')->success()->important();
    return Redirect::to('venta');
  }

}

