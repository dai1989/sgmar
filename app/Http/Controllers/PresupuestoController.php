<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;

use App\Http\Requests\PresupuestoFormRequest;
use App\Models\Persona;

use App\Presupuesto;

use App\DetallePresupuesto;

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
           $presupuesto=DB::table('presupuesto as pr')
            ->join('personas as p','pr.persona_id','=','p.id')
            ->join('detalle_presupuesto as dp','pr.idpresupuesto','=','dp.idpresupuesto')
            ->select('pr.idpresupuesto','pr.fecha_hora','p.nombre','pr.tipo_comprobante','pr.num_comprobante','pr.impuesto','pr.estado','pr.total_venta')
            ->where('pr.fecha_hora','LIKE','%'.$query.'%')
            ->orderBy('pr.idpresupuesto','desc')
            ->groupBy('pr.idpresupuesto','pr.fecha_hora','p.nombre','pr.tipo_comprobante','pr.num_comprobante','pr.impuesto','pr.estado', 'pr.total_venta')
            ->paginate(7);
            return view('presupuesto.index',["presupuesto"=>$presupuesto,"searchText"=>$query]);

        }

    }
    public function create()
    {
     $personas=Persona::all();
     $productos = DB::table('productos as prod')
        ->join('detalle_ingreso as di', 'prod.idproducto', '=', 'di.idproducto' )
            ->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS producto'),'prod.idproducto', 'prod.stock',DB::raw('avg(di.precio_venta) as precio_promedio'))
            ->where('prod.estado','=','Activo')
            ->where('prod.stock','>','0')
            ->groupBy('producto','prod.idproducto','prod.stock')
            ->get();
        return view("presupuesto.create",["personas"=>$personas,"productos"=>$productos]);
    }

     public function store (PresupuestoFormRequest $request)
    {
        //dd($request->get('idarticulo'));

        $fecha= DB::table('presupuesto')
                    ->select('presupuesto.fecha_hora')
                    ->orderBy('idpresupuesto','desc')
                    ->first();
        $mytime = Carbon::now('America/Argentina/Mendoza');
        $ventaact=$mytime->toDateString();

        $ultimoid= DB::table('presupuesto')
                    ->orderBy('idpresupuesto','desc')
                    ->first();
        $ultimodetalle= DB::table('detalle_presupuesto')
                    ->orderBy('idpresupuesto','desc')
                    ->first();
        //dd($request->get('total_venta'));
        //dd($totalpro);
    if (Presupuesto::exists()) {
        if ($ventaact == $fecha->fecha_hora) {
           $totalpro = $ultimoid->total_venta + $request->get('total_venta');
           $venta=Presupuesto::findOrFail($ultimoid->idpresupuesto);
           $venta->tipo_comprobante='recaudacion';
           $venta->num_comprobante=000;
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

        }else {
          DB::beginTransaction();
          $venta=new Presupuesto;
          $venta->persona_id=1;
          $venta->tipo_comprobante='Recaudación';
          $venta->num_comprobante=000;
          $venta->total_venta=$request->get('total_venta');
          $venta->idusuario=$request->get('idusuario');

          $mytime = Carbon::now('America/Argentina/Mendoza');
          $venta->fecha_hora=$mytime->toDateString();
          $venta->impuesto='21';
          $venta->estado='Sin Revisar';
          $venta->save();

          $idproducto = $request->get('idproducto');
          $cantidad = $request->get('cantidad');
          $descuento = $request->get('descuento');
          $precio_venta = $request->get('precio_venta');

          $cont = 0;

          while($cont < count($idproducto)){
              $detalle = new DetallePresupuesto();
              $detalle->idpresupuesto= $venta->idpresupuesto;
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
        $venta=new Presupuesto;
        $venta->persona_id=$request->get('persona_id');
        $venta->tipo_comprobante='recaudacion';
        $venta->num_comprobante=000;
        $venta->total_venta=$request->get('total_venta');
        $venta->idusuario=$request->get('idusuario');

        $mytime = Carbon::now('America/Argentina/Mendoza');
        $venta->fecha_hora=$mytime->toDateString();
        $venta->impuesto='21';
        $venta->estado='Sin Revisar';
        $venta->save();

        $idproducto = $request->get('idproducto');
        $cantidad = $request->get('cantidad');
        $descuento = $request->get('descuento');
        $precio_venta = $request->get('precio_venta');

        $cont = 0;

        while($cont < count($idproducto)){
            $detalle = new DetallePresupuesto();
            $detalle->idpresupuesto= $venta->idpresupuesto;
            $detalle->idproducto= $idproducto[$cont];
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
     $venta=DB::table('presupuesto as v')
            ->join('personas as p','v.persona_id','=','p.id')
            ->join('detalle_presupuesto as dv','v.idpresupuesto','=','dv.idpresupuesto')
            ->select('v.idpresupuesto','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario')
            ->groupBy('v.idpresupuesto','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario')
            ->where('v.idpresupuesto','=',$id)
            ->first();
        $detalles=DB::table('detalle_presupuesto as d')
             ->join('productos as prod','d.idproducto','=','prod.idproducto')
             ->select('prod.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta')
             ->where('d.idpresupuesto','=',$id)
             ->orderBy('created_at', 'desc')
             ->get();
        $usuario=DB::table('users')
                    ->where('id','=',$venta->idusuario)
                    ->first();
    //    dd($usuario);
        return view("presupuesto.show",["venta"=>$venta,"detalles"=>$detalles,"usuario"=>$usuario]);

    }

    public function destroy($id)
    {
       $fecha = DB::table('presupuesto')
                ->where('idpresupuesto','=',$id)
                ->first();

       $venta=Presupuesto::findOrFail($id);
       $venta->estado='Revisado';
       $venta->update();

       flash('Su recaudación del dia '.date("d-m-Y", strtotime($fecha->fecha_hora)).', fue dada como revisada ')->important();

        return Redirect::to('presupuesto');
    }

}
