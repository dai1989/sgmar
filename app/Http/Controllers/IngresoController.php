<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\IngresoFormRequest;

use App\Ingreso;

use App\Models\Persona;
use App\Models\Proveedor;

use App\DetalleIngreso;

use DB;

use Carbon\Carbon;

use Response;

use Illuminate\Support\Collection;

class IngresoController extends Controller
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
      $ingresos=DB::table('ingreso as i')
      ->join('proveedores as p','i.proveedor_id','=','p.id')
      ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
      ->select('p.razonsocial','p.cuit','p.id','i.idingreso','i.fecha_hora','i.tipo_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
      ->where('i.num_comprobante','LIKE','%'.$query.'%')
      ->orderBy('i.idingreso','desc')
      ->groupBy('p.razonsocial','p.cuit','p.id','i.idingreso','i.fecha_hora','i.tipo_comprobante','i.num_comprobante','i.impuesto','i.estado')
      ->paginate(7);

      return view('ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);

    }
  }
  public function create()
  {
    $proveedores=Proveedor::all();
    $productos = DB::table('productos as prod')
    ->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS producto'),'prod.idproducto')
    ->where('prod.estado','=','Activo')
    ->get();
    $ing= Ingreso::all()->last();
    if ($ing==null) {
      $ing='1';
      return view("ingreso.create",["proveedores"=>$proveedores,"productos"=>$productos,"ing"=>$ing]);
    }
    else
    {
      $ing= Ingreso::all()->last();
      return view("ingreso.create",["proveedores"=>$proveedores,"productos"=>$productos,"ing"=>$ing]);
    }
  }

  public function store (IngresoFormRequest $request)
  {

    // dd($request);
    if ($request->get('proveedor_id') == null) {
      $proveedor=new Proveedor;
      
      $proveedor->razonsocial=$request->get('razonsocial');
      $proveedor->cuit=$request->get('cuit');
     
      $proveedor->save();

      $ultimapersona = DB::table('proveedores')
      ->orderBy('id','desc')
      ->first();

      DB::beginTransaction();
      $ingreso=new Ingreso;
      $ingreso->proveedor_id=$ultimapersona->id;
      $ingreso->tipo_comprobante=$request->get('tipo_comprobante');
      $ingreso->num_comprobante=$request->get('num_comprobante');

      $mytime = Carbon::now('America/Argentina/Mendoza');
      $ingreso->fecha_hora=$mytime->toDateTimeString();
      $ingreso->impuesto='21';
      $ingreso->estado='Sin cancelar';
      $ingreso->save();

      $idproducto = $request->get('idproducto');
      $cantidad = $request->get('cantidad');
      $precio_compra = $request->get('precio_compra');
      $precio_venta = $request->get('precio_venta');

      $cont = 0;

      while($cont < count($idproducto)){
        $detalle = new DetalleIngreso();
        $detalle->idingreso= $ingreso->idingreso;
        $detalle->idproducto= $idproducto[$cont];
        $detalle->cantidad= $cantidad[$cont];
        $detalle->precio_compra= $precio_compra[$cont];
        $detalle->precio_venta= $precio_venta[$cont];
        $detalle->save();
        $cont=$cont+1;
      }


      DB::commit();

    }
    else {

      DB::beginTransaction();
      $ingreso=new Ingreso;
      $ingreso->proveedor_id=$request->get('proveedor_id');
      $ingreso->tipo_comprobante=$request->get('tipo_comprobante');
      $ingreso->num_comprobante=$request->get('num_comprobante');

      $mytime = Carbon::now('America/Argentina/Mendoza');
      $ingreso->fecha_hora=$mytime->toDateTimeString();
      $ingreso->impuesto='18';
      $ingreso->estado='Sin cancelar';
      $ingreso->save();

      $idproducto = $request->get('idproducto');
      $cantidad = $request->get('cantidad');
      $precio_compra = $request->get('precio_compra');
      $precio_venta = $request->get('precio_venta');

      $cont = 0;

      while($cont < count($idproducto)){
        $detalle = new DetalleIngreso();
        $detalle->idingreso= $ingreso->idingreso;
        $detalle->idproducto= $idproducto[$cont];
        $detalle->cantidad= $cantidad[$cont];
        $detalle->precio_compra= $precio_compra[$cont];
        $detalle->precio_venta= $precio_venta[$cont];
        $detalle->save();
        $cont=$cont+1;
      }

      DB::commit();
    }
    $ing= Ingreso::all()->last();
    $pro= Proveedor::findOrFail($ing->proveedor_id);
    flash('Su ingreso, del proveedor '.$pro->razonsocial.' ha sido creado correctamente')->important();
    return Redirect::to('ingreso');
  }

  public function show($id)
  {
    $ingreso=DB::table('ingreso as i')
    ->join('proveedores as p','i.proveedor_id','=','p.id')
    ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    ->select('i.idingreso','i.fecha_hora','p.razonsocial','i.tipo_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    ->groupBy('i.idingreso','i.fecha_hora','p.razonsocial','i.tipo_comprobante','i.num_comprobante','i.impuesto','i.estado')
    ->where('i.idingreso','=',$id)
    ->first();

    $detalles=DB::table('detalle_ingreso as d')
    ->join('productos as prod','d.idproducto','=','prod.idproducto')
    ->select('d.created_at','prod.descripcion as producto','d.cantidad','d.precio_compra','d.precio_venta')
    ->where('d.idingreso','=',$id)
    ->get();
    return view("ingreso.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);
  }

  public function destroy($id)
  {
    $ingreso=Ingreso::findOrFail($id);
    $ingreso->Estado='Cancelada';
    $ingreso->update();
    $ing= Ingreso::findOrFail($id);
    $pro= Proveedor::findOrFail($ing->proveedor_id);
    flash('Su ingreso, del proveedor '.$pro->razonsocial.' ha sido cancelada correctamente')->success()->important();
    return Redirect::to('ingreso');
  }
}
