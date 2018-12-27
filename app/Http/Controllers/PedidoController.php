<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreatePedidoRequest;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Persona;
use App\Models\Producto;
use App\Models\Proveedor;
use App\User;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection; 
class PedidoController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if($request)
    	{
    		$query=trim($request->GET('searchText'));

        $pedidos=DB::table('pedidos as pe')
         -> join('proveedores as p','pe.id_proveedor','=','p.id')
        ->join('pedido_detalles as dp','pe.id','=','dp.id_pedido')
    		->select('pe.id','pe.fecha_hora','p.razonsocial','pe.num_comprobante','v.total_venta')
    		->where('pe.num_comprobante','LIKE','%'.$query.'%')
    		->orderBy('pe.id','desc')
    		->groupBy('pe.id','pe.fecha_hora','p.razonsocial','pe.num_comprobante')
    		->paginate(7);
    		return view('pedidos.index',["pedidos"=>$pedidos,"searchText"=>$query]);
    	}
    }

    	public function create()
    	{
            $ipedido=DB::table('pedidos')->max('id')+1; //as incredible
            $proveedores = Proveedor::all();
            $user_list = User::all();
            $productos=DB::table('productos as prod')
            ->join('pedido_detalles as di','prod.id','=','di.id_producto')
            ->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS productos'),'prod.id','prod.stock', 'di.precio_venta') //esta consulta extrae el promedio del valor de venta del producto
            ->where('prod.estado','=','Activo')
             // solo muestra articulos con stock en positivo
            ->groupBy('productos','prod.id')
    		->get();
			return view('pedidos.create',["proveedores"=>$proveedores,"productos"=>$productos, "ipedido"=>$ipedido,"user_list"=>$user_list]);
       	}
            public function show($id)
        {
            $venta=DB::table('pedidos as pe')
            -> join('proveedores as p','pe.id_proveedor','=','p.id')
            ->join('pedido_detalles as dp','pe.id','=','dp.id_pedido')
            ->select('pe.id','pe.fecha_hora','p.razonsocial','pe.num_comprobante','v.total_venta')
            ->where('pe.id','=',$id)
            ->first();    

            $detalles=DB::table('pedido_detalles as dp')
            ->join('productos as prod','dp.id_producto','=','prod.id')
            ->select('prod.descripcion as productos','dp.cantidad','dp.descuento','dp.precio_venta')
            ->where('dp.id_pedido',$id)
            ->get();
        return view('pedidos.show',["venta"=>$venta,"detalles"=>$detalles]);
        }

    public function edit($id)
    {
            $venta=DB::table('pedidos as pe')
            ->join('pedido_detalles as dp','pe.id','=','dp.id_pedido')
            ->select('v.total_venta','pe.id','dp.id')
            ->where('pe.id','=',$id)
            ->first();

            $detalles=DB::table('pedido_detalles as dp')     
            ->join('productos as prod','prod.id','=','dp.id_producto')
            ->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS productos'),'dp.id_producto','dp.cantidad','dp.descuento','dp.id as id' ,'dp.precio_venta')
            ->where('dp.id',$id)
            ->get();

            $productos=DB::table('productos as prod')
            ->join('detalle_ingreso as di','prod.id','=','di.id_producto')
            ->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS productos'),'prod.id','prod.stock', DB::raw('avg(di.precio_venta) as precio_promedio')) //esta consulta extrae el promdio del valor de venta del producto
            ->where('prod.estado','=','Activo')
            ->where('prod.stock','>','0') // solo muestra articulos con stock en positivo
            ->groupBy('productos','prod.id','prod.stock')
            ->get();

    return view("pedidos.edit", ["venta"=>$venta,"productos"=>$productos,"detalles"=>$detalles]);
            
    }
   public function destroy($id)
        
        {   
   
        }

       		public function store(Pedido $request) {
                
    		try{
    			DB::beginTransaction();
    			$pedido=new Pedido();
    			$pedido->id_proveedor = $request -> get('id_proveedor');
    			$pedido->id_user = $request -> get('id_user');
    			$pedido->num_comprobante=$request->get('num_comprobante');
                $pedido->total_compra=$request->get('total_venta');
    			$mytime = Carbon::now('America/Argentina/Salta');
    			$pedido->fecha_hora=$mytime->toDateTimeString();
    			//$ingreso->impuesto='16';//$request->get('impuesto');//16%
                $pedido->estado='A';
                $pedido->condiciones=$request->get('condiciones');
                //$venta->idproyecto=$request->get('idproyecto');
    		       $pedido->save();
    			$id_producto=$request->get('id_producto');
    			$cantidad=$request->get('cantidad');
    			$descuento=$request->get('descuento');
    			$precio_venta=$request->get('precio_venta');
    			$cont=0;
                   
    			While($cont < count($id_producto))
                {
    				$detalles=new PedidoDetalle();
    				$detalles->id_pedido=$pedido->id_pedido;
    				$detalles->id_producto=$id_producto[$cont];
    				$detalles ->cantidad=$cantidad[$cont];
    				$detalles->precio_venta=$precio_venta[$cont];
    				$detalles->save();
    				$cont=$cont+1;
    			}
    			DB::commit();
        		}
                catch(\Exception $e)
                {

			    DB::rollback();
                }   
                return Redirect::to('venta');
    	      }

        public function crear_pdf($id)
     {
            $venta=DB::table('pedidos as pe')
            ->join('proveedores as p','pe.id_proveedor','=','p.id')
            ->join('pedido_detalles as dp','pe.id','=','dp.id_pedido')
            ->select('pe.id','pe.fecha_hora','p.razonsocial','p.id', 'p.tipo_documento','p.num_documento','pe.num_comprobante','v.total_venta','dp.id')
            ->where('pe.id','=',$id)
            ->first(); 

            $detalle=DB::table('pedido_detalles as dp')
            ->join('productos as prod','dp.id_producto','=','prod.id')
            ->select('prod.descripcion as productos','prod.barcode','prod.imagen','dp.cantidad','dp.descuento','dp.precio_venta')
            ->where('id_pedido',$id)
            ->get();

             $date = date('Y-m-d');
             $pdf=  \PDF::loadview('pedidos.reporte',["detalle"=>$detalle, "venta"=>$venta]) ->setPaper('letter', 'portrait');
           return $pdf->stream('reporte.pdf');
        }
  
}

