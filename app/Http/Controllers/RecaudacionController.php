<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;


use App\Http\Requests\CreateRecaudacionRequest;
use App\Models\Recaudacion;
use App\Models\DetalleRecaudacion;
use App\Models\Persona;
use App\User;
use DB;

use Carbon\Carbon;

use Response;

use Illuminate\Support\Collection;
class RecaudacionController extends Controller
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
					 $recaudacion=DB::table('recaudacion as rec')
						->join('personas as p','rec.persona_id','=','p.id')
						->join('detalle_recaudacion as dr','rec.id','=','dr.recaudacion_id')
						->select('rec.id','rec.fecha_hora','p.nombre','rec.tipo_comprobante','rec.num_comprobante','rec.impuesto','rec.estado','rec.total_venta')
						->where('rec.fecha_hora','LIKE','%'.$query.'%')
						->orderBy('rec.id','desc')
						->groupBy('rec.id','rec.fecha_hora','p.nombre','rec.tipo_comprobante','rec.num_comprobante','rec.impuesto','rec.estado', 'rec.total_venta')
						->paginate(7);
						return view('recaudacion.index',["recaudacion"=>$recaudacion,"searchText"=>$query]);

				}

		}
		public function create()
		{
		 $personas = Persona::all();
		 $productos = DB::table('productos as prod')
				->join('detalles_ingresos as di', 'prod.id', '=', 'di.id_producto' )
						->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS producto'),'prod.id', 'prod.stock','prod.precio_venta',DB::raw('avg(di.precio_venta) as precio_promedio'))
						->where('prod.estado','=','Activo')
						->where('prod.stock','>','0')
						->groupBy('producto','prod.id','prod.stock','prod.precio_venta')
						->get();
				return view("recaudacion.create",["personas"=>$personas,"productos"=>$productos]);
		}

		 public function store (CreateRecaudacionRequest $request)
		{
				//dd($request->get('idarticulo'));

				$fecha= DB::table('recaudacion')
										->select('recaudacion.fecha_hora')
										->orderBy('id','desc')
										->first();
				$mytime = Carbon::now('America/Argentina/Mendoza');
	 			$ventaact=$mytime->toDateString();

				$ultimoid= DB::table('recaudacion')
										->orderBy('id','desc')
										->first();
				$ultimodetalle= DB::table('detalle_recaudacion')
										->orderBy('recaudacion_id','desc')
										->first();
				//dd($request->get('total_venta'));
				//dd($totalpro);
		if (Recaudacion::exists()) {
				if ($ventaact == $fecha->fecha_hora) {
					 $totalpro = $ultimoid->total_venta + $request->get('total_venta');
					 $venta=Recaudacion::findOrFail($ultimoid->id);
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
							$detalle = new DetalleRecaudacion();
							$detalle->recaudacion_id= $ultimoid->id;
							$detalle->id_producto= $id_producto[$cont];
							$detalle->cantidad= $cantidad[$cont];
							$detalle->descuento= $descuento[$cont];
							$detalle->precio_venta= $precio_venta[$cont];
							$detalle->save();
							$cont=$cont+1;
					}

				}else {
					DB::beginTransaction();
					$venta=new Recaudacion;
					$venta->persona_id=1;
					$venta->tipo_comprobante='Recaudación';
					$venta->num_comprobante=000;
					$venta->total_venta=$request->get('total_venta');
					$venta->user_id=$request->get('user_id');

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
							$detalle = new DetalleRecaudacion();
							$detalle->recaudacion_id= $venta->id;
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
				$venta=new Recaudacion;
				$venta->persona_id=$request->get('persona_id');
				$venta->tipo_comprobante='recaudacion';
				$venta->num_comprobante=000;
				$venta->total_venta=$request->get('total_venta');
				$venta->user_id=$request->get('user_id');

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
						$detalle = new DetalleRecaudacion();
						$detalle->recaudacion_id= $venta->id;
						$detalle->id_producto= $id_producto[$cont];
						$detalle->cantidad= $cantidad[$cont];
						$detalle->descuento= $descuento[$cont];
						$detalle->precio_venta= $precio_venta[$cont];
						$detalle->save();
						$cont=$cont+1;
				}
				DB::commit();
			}
				return Redirect::to('recaudacion');
		}

		public function show($id)
		{
		 $venta=DB::table('recaudacion as v')
						->join('persona as p','v.persona_id','=','p.id')
						->join('detalle_recaudacion as dr','v.id','=','dr.recaudacion_id')
						->select('v.id','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','user_id')
						->groupBy('v.id','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','user_id')
						->where('v.id','=',$id)
						->first();
				$detalles=DB::table('detalle_recaudacion as dr')
						 ->join('productos as prod','dr.id_producto','=','prod.id')
						 ->select('prod.descripcion as productos','dr.created_at','dr.cantidad','dr.descuento','dr.precio_venta')
						 ->where('dr.recaudacion_id','=',$id)
						 ->orderBy('created_at', 'desc')
						 ->get();
				$user=DB::table('users')
										->where('id','=',$venta->user_id)
										->first();
		//		dd($usuario);
				return view("recaudacion.show",["venta"=>$venta,"detalles"=>$detalles,"user"=>$user]);

		}

		public function destroy($id)
		{
			 $fecha = DB::table('recaudacion')
			 					->where('id','=',$id)
								->first();

			 $venta=Recaudacion::findOrFail($id);
			 $venta->estado='Revisado';
			 $venta->update();

			 flash('Su recaudación del dia '.date("d-m-Y", strtotime($fecha->fecha_hora)).', fue dada como revisada ')->important();

				return Redirect::to('recaudacion');
		}

}

