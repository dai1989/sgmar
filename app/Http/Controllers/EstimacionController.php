<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Collection;

use App\Http\Requests\EstimacionRequest;

use App\Estimacion;

use App\DetalleEstimacion;
use App\Models\Venta;
use App\Models\TipoFactura;
use App\Models\TipoPago;
use App\Models\DetalleVenta;
use App\Models\Persona;
use App\Presupuesto;

use App\Categoria;
use App\User;



use App\DetallePresupuesto;

use DB;

use Carbon\Carbon;

use Response;

use GameSettingsTrait;

class EstimacionController extends Controller
{
  public function __construct()
  {
     $this -> middleware('auth');
  }

  public function index(Request $request)
  {

    if ($request)
    {
      $query=trim($request->get('searchText'));
      $estimacion=DB::table('estimacion as e')
      ->join('detalle_estimacion as de','e.id','=','de.estimacion_id')
      ->select('e.id','e.fecha_hora','e.impuesto','e.estado','e.total_venta')
      ->where('e.fecha_hora','LIKE','%'.$query.'%')
      ->orderBy('e.id','desc')
      ->groupBy('e.id','e.fecha_hora','e.impuesto','e.estado','e.total_venta')
      ->paginate(7);
      return view('estimacion.index',["estimacion"=>$estimacion,"searchText"=>$query]);

    }
  }
  public function create()
  {
    $productos = DB::table('productos as prod')
    ->join('detalles_ingresos as di', 'prod.id', '=', 'di.id_producto' )
    ->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS producto'),'prod.id','prod.imagen','prod.stock','prod.precio_venta',DB::raw('avg(di.precio_venta) as precio_promedio'))
    ->where('prod.estado','=','Activo')
    ->where('prod.stock','>','0')
    ->groupBy('producto','prod.id','prod.stock','prod.imagen','prod.precio_venta')
    ->get();
    //  dd($articulos);
    return view("estimacion.create",["productos"=>$productos]);
  }

  public function store (EstimacionRequest $request)
  {
    // dd($request);

    DB::beginTransaction();
    $estimacion=new Estimacion;
    $estimacion->total_venta=$request->get('total_venta');
    $estimacion->user_id=$request->get('user_id');

    $mytime = Carbon::now('America/Argentina/Mendoza');
    $estimacion->fecha_hora=$mytime->toDateTimeString();
    $estimacion->impuesto='0.21';
    $estimacion->estado='Venta Sin Realizar';
    $estimacion->save();

    $id_producto = $request->get('id_producto');
    $cantidad = $request->get('cantidad');
    $descuento = $request->get('descuento');
    $precio_venta = $request->get('precio_venta');

    $cont = 0;

    while($cont < count($id_producto)){
      $detalle = new DetalleEstimacion();
      $detalle->estimacion_id= $estimacion->id;
      $detalle->id_producto= $id_producto[$cont];
      $detalle->cantidad= $cantidad[$cont];
      $detalle->descuento= $descuento[$cont];
      $detalle->precio_venta= $precio_venta[$cont];
      $detalle->save();
      $cont=$cont+1;
    }
    DB::commit();
    $user=DB::table('users')
    ->where('id','=',$estimacion->user_id)
    ->first();

    flash('Su presupuesto fue registrado por el usuario '.$user->name.' correctamente')->success()->important();

    return Redirect::to('estimacion');

  }

  public function show($id)
  {
    $estimacion=DB::table('estimacion as e')
    ->join('detalle_estimacion as de','e.id','=','de.estimacion_id')
    ->select('e.id','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.user_id')
    ->groupBy('e.id','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.user_id')
    ->where('e.id','=',$id)
    ->first();
    //dd($estimacion);
    $detalles=DB::table('detalle_estimacion as d')
    ->join('productos as p','d.id_producto','=','p.id')
    ->select('p.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta')
    ->where('d.estimacion_id','=',$id)
    ->get();
    
    return view("estimacion.show",["estimacion"=>$estimacion,"detalles"=>$detalles]);

  }

  public function estimacionventa($id)
  {

       $user_list = User::all();
       $tipofactura_list = TipoFactura::all();
       $tipopago_list = TipoPago::all();
       $personas = Persona::all();
    // dd($personas);
       $estimacion=DB::table('estimacion as e')
    ->join('detalle_estimacion as de','e.id','=','de.estimacion_id')
    ->select('e.id','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.user_id')
    ->groupBy('e.id','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.user_id')
    ->where('e.id','=',$id)
    ->first();
    //dd($estimacion);
    $detalles=DB::table('detalle_estimacion as d')
    ->join('productos as a','d.id_producto','=','a.id')
    ->select('a.id','a.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta')
    ->where('d.estimacion_id','=',$id)
    ->get();
    $ven= Venta::all()->last();
    if ($ven==null)
    {
      $ven='1';
     return view("estimacionventa",["estimacion"=>$estimacion,"detalles"=>$detalles,"personas"=>$personas,"ven"=>$ven,'user_list' =>$user_list,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list]);
    }
    else {
      return view("estimacion.estimacionventa",["estimacion"=>$estimacion,"detalles"=>$detalles,"personas"=>$personas,"ven"=>$ven,'user_list' =>$user_list,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list]);
    }
  }

  public function crearventa(Request $request)
  {

    $esti=DB::table('estimacion')
    ->where('id','=',$request->id)
    ->first();
    // dd($esti->estado);

    if ($esti->estado == "Venta Sin Realizar") {
      $estimacion=DB::table('estimacion as e')
      ->join('detalle_estimacion as de','e.id','=','de.estimacion_id')
      ->select('e.id','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.user_id')
      ->groupBy('e.id','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.user_id')
      ->where('e.id','=',$request->id)
      ->first();

      $detalles=DB::table('detalle_estimacion as d')
      ->join('productos as a','d.id_producto','=','a.id')
      ->select('a.id','a.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta')
      ->where('d.estimacion_id','=',$request->estimacion_id)
      ->get();


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

     
      // $fe = "";
        //  dd(isset($fecha->fecha_hora));

      if (Presupuesto::exists() && isset($fecha->fecha_hora) == true) {
          // dd(isset($fecha->fecha_hora));
        if ( $ventaact == $fecha->fecha_hora) {
          $totalpro = $ultimoid->total_venta + $estimacion->total_venta;
          $venta=Presupuesto::findOrFail($ultimoid->id);
          $venta->total_venta=$totalpro;
          $venta->update();

          $id_producto = $request->get('id_producto');
      $cantidad = $request->get('cantidad');
      $descuento = $request->get('descuento');
      $precio_venta = $request->get('precio_venta');
          $cont = 0;

          while($cont < count($id_producto)){
            $detalle = new DetallePresupuesto();
            $detalle->presupuesto_id= $ultimoid->id;
            $detalle->id_producto= $id_producto[$cont];
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
          $presupuesto->persona_id=$request->get('persona_id');
          $presupuesto->tipo_comprobante=$request->get('tipo_comprobante');
          $presupuesto->num_comprobante=$request->get('num_comprobante');
          $presupuesto->total_venta= $estimacion->total_venta;
          $presupuesto->user_id=$request->get('user_id');

          $mytime = Carbon::now('America/Argentina/Mendoza');
          $presupuesto->fecha_hora=$mytime->toDateTimeString();
          $presupuesto->impuesto='0.21';
          $presupuesto->estado='Sin Revisar';
          $presupuesto->save();


            $id_producto = $request->get('id_producto');
      $cantidad = $request->get('cantidad');
      $descuento = $request->get('descuento');
      $precio_venta = $request->get('precio_venta');

          $cont = 0;

          while($cont < count($id_producto)){
            $detalle = new DetallePresupuesto();
            $detalle->presupuesto_id= $presupuesto->id;
            $detalle->id_producto= $id_producto[$cont];
            $detalle->cantidad= $cantidad[$cont];
            $detalle->descuento= $descuento[$cont];
            $detalle->precio_venta= $precio_venta[$cont];
            $detalle->save();
            $cont=$cont+1;
          }
          DB::commit();
        }
      }
     
      DB::beginTransaction();
      $venta=new Venta;
      $venta->persona_id=$request->get('persona_id');
      $venta->tipo_comprobante=$request->get('tipo_comprobante');
      $venta->num_comprobante=$request->get('num_comprobante');
      $venta->total_venta=$estimacion->total_venta;
      $venta->user_id=$request->get('user_id');
      $venta->entrega=$request->get('entrega');
       $venta ->tipofactura_id = $request -> get('tipofactura_id');
      $venta ->tipopago_id = $request -> get('tipopago_id');
      $venta ->tipo_comprobante = $request -> get('tipo_comprobante');

      $mytime = Carbon::now('America/Argentina/Mendoza');
      $venta->fecha_hora=$mytime->toDateTimeString();
      $venta->impuesto='0.21';
      $venta->estado='Sin Revisar';
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

      $venta=Estimacion::findOrFail($request->id);
      $venta->estado='Venta Realizada';
      $venta->update();
      flash('Su venta fue registrada correctamente')->important();
      return Redirect::to('venta');

    }
    else {
      flash('Su venta ya fue registrada, si decea, haga un nuevo presupuesto y realize una nueva venta. O Cree una nueva venta.')->warning()->important();

      return Redirect::to('estimacion');
    }

  }
}
