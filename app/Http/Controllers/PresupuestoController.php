<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;

use App\Http\Requests\PresupuestoFormRequest;
use App\Presupuesto;
use App\User;
use App\DetallePresupuesto;
use App\Models\Persona; 
use App\Models\TipoPago;
use App\Models\TipoFactura;

use DB;

use Carbon\Carbon;

use Response;

use Illuminate\Support\Collection;

class PresupuestoController extends Controller
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
           $presupuesto=DB::table('presupuestos as pr')
            ->join('personas as p','pr.persona_id','=','p.id')
            ->join('presupuesto_detalles as dp','pr.id','=','dp.presupuesto_id')
            ->select('pr.id','pr.fecha_hora','p.nombre','p.apellido','pr.tipo_comprobante','pr.num_comprobante','pr.impuesto','pr.estado','pr.total_venta')
            ->where('pr.fecha_hora','LIKE','%'.$query.'%')
            ->orderBy('pr.id','desc')
            ->groupBy('pr.id','pr.fecha_hora','p.nombre','pr.tipo_comprobante','pr.num_comprobante','pr.impuesto','pr.estado', 'pr.total_venta')
            ->paginate(7);
            return view('presupuesto.index',["presupuesto"=>$presupuesto,"searchText"=>$query]);

        }

    }
    public function create()
    {
     $personas = Persona::all();
     $user_list = User::all();
     $tipofactura_list = TipoFactura::all();
     $tipopago_list = TipoPago::all();
     $productos = DB::table('productos as prod')
        ->join('detalles_ingresos as di', 'prod.id', '=', 'di.id_producto' )
            ->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS producto'),'prod.id', 'prod.stock',DB::raw('avg(di.precio_venta) as precio_promedio'))
            ->where('prod.estado','=','Activo')
            ->where('prod.stock','>','0')
            ->groupBy('producto','prod.id','prod.stock')
            ->get();
        return view("presupuesto.create",["personas"=>$personas,"productos"=>$productos,'user_list' =>$user_list,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list]);
    }

     public function store (PresupuestoFormRequest $request)
    {
        //dd($request->get('idarticulo'));

        $fecha= DB::table('presupuestos')
                    ->select('presupuestos.fecha_hora')
                    ->orderBy('id','desc')
                    ->first();
        $mytime = Carbon::now('America/Argentina/Mendoza');
        $ventaact=$mytime->toDateString();

        $ultimoid= DB::table('presupuestos')
                    ->orderBy('id','desc')
                    ->first();
        $ultimodetalle= DB::table('presupuesto_detalles')
                    ->orderBy('id','desc')
                    ->first();
        //dd($request->get('total_venta'));
        //dd($totalpro);
    if (Presupuesto::exists()) {
        if ($ventaact == $fecha->fecha_hora) {
           $totalpro = $ultimoid->total_venta + $request->get('total_venta');
           $venta=Presupuesto::findOrFail($ultimoid->id);
           $venta->tipo_comprobante='recaudacion';
           $venta->num_comprobante=000;
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

        }else {
          DB::beginTransaction();
          $venta=new Presupuesto;
          $venta->persona_id=1;
          $venta->tipo_comprobante='Recaudación';
          $venta->num_comprobante=000;
          $venta->total_venta=$request->get('total_venta');
          $venta->user_id=$request->get('user_id');
          $venta->tipofactura_id = $request -> get('tipofactura_id');
          $venta->tipopago_id = $request -> get('tipopago_id');
          $venta->tipo_comprobante=$request->get('tipo_comprobante');

          $mytime = Carbon::now('America/Argentina/Mendoza');
          $venta->fecha_hora=$mytime->toDateString();
          $venta->impuesto='0.21';
          $venta->estado='Sin Revisar';
          $venta->save();

          $id_producto = $request->get('id_producto');
          $cantidad = $request->get('cantidad');
          $descuento = $request->get('descuento');
          $precio_venta = $request->get('precio_venta');

          $cont = 0;

          while($cont < count($id_producto)){
              $detalle = new DetallePresupuesto();
              $detalle->presupuesto_id= $venta->id;
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
      else {
        DB::beginTransaction();
        $venta=new Presupuesto;
        $venta->persona_id=$request->get('persona_id');
        $venta->tipo_comprobante='recaudacion';
        $venta->num_comprobante=000;
        $venta->total_venta=$request->get('total_venta');
        $venta->user_id=$request->get('user_id');
        $venta ->tipofactura_id = $request -> get('tipofactura_id');
        $venta->tipopago_id = $request -> get('tipopago_id');
        $venta->tipo_comprobante=$request->get('tipo_comprobante');

        $mytime = Carbon::now('America/Argentina/Mendoza');
        $venta->fecha_hora=$mytime->toDateString();
        $venta->impuesto='0.21';
        $venta->estado='Sin Revisar';
        $venta->save();

        $id_producto = $request->get('id_producto');
        $cantidad = $request->get('cantidad');
        $descuento = $request->get('descuento');
        $precio_venta = $request->get('precio_venta');

        $cont = 0;

        while($cont < count($id_producto)){
            $detalle = new DetallePresupuesto();
            $detalle->presupuesto_id= $venta->id;
            $detalle->id_producto= $id_producto[$cont];
            $detalle->cantidad= $cantidad[$cont];
            $detalle->descuento= $descuento[$cont];
            $detalle->precio_venta= $precio_venta[$cont];
            $detalle->save();
            $cont=$cont+1;
        }
        DB::commit();
      }
        return Redirect::to('presupuesto');
    }

    public function show($id)
    {
     $venta=DB::table('presupuestos as v')
            ->join('personas as p','v.persona_id','=','p.id')
            ->join('presupuesto_detalles as dv','v.id','=','dv.presupuesto_id')
            ->select('v.id','v.fecha_hora','p.nombre','p.apellido','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','user_id')
            ->groupBy('v.id','v.fecha_hora','p.nombre','p.apellido','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','user_id')
            ->where('v.id','=',$id)
            ->first();
        $detalles=DB::table('presupuesto_detalles as pd')
             ->join('productos as prod','pd.id_producto','=','prod.id')
             ->select('prod.descripcion as producto','pd.created_at','pd.cantidad','pd.descuento','pd.precio_venta')
             ->where('pd.presupuesto_id','=',$id)
             ->orderBy('created_at', 'desc')
             ->get();
        $user=DB::table('users')
                    ->where('id','=',$venta->user_id)
                    ->first();
    //    dd($usuario);
        return view("presupuesto.show",["venta"=>$venta,"detalles"=>$detalles,"user"=>$user]);

    }

    public function destroy($id)
    {
       $fecha = DB::table('presupuestos')
                ->where('id','=',$id)
                ->first();

       $venta=Presupuesto::findOrFail($id);
       $venta->estado='Cancelado';
       $venta->update();

       flash('Su recaudación del dia '.date("d-m-Y", strtotime($fecha->fecha_hora)).', fue dada como cancelada ')->important();

        return Redirect::to('presupuesto');
    }

}
