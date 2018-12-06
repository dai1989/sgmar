<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateCreditoRequest;

use App\Models\Credito;
use App\Models\Producto;
use App\Models\Autorizacion;
use App\Models\DetalleCredito;
use App\User;
use App\Models\TipoPago;
use App\Models\TipoFactura;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class CreditoController extends Controller
{
    
    //contructor
    public function __construct()
    {
        $this -> middleware('auth');
    }

    //index 
    public function index(Request $request)
    {
      if($request)
      {
        //almacenar la busqueda 
        $querry =  trim ($request -> get('searchText'));
        //obtener 
        $creditos = DB::table('creditos as c') 
        -> join('autorizacion as a','c.id_autorizacion','=','a.id')
        -> join('detalles_creditos as dc','c.id','=','dc.id_credito')
        -> select('c.id', 'c.fecha_hora', 'a.codigo', 'a.monto_actual', 'c.tipo_comprobante', 'c.serie_comprobante', 'c.num_comprobante', 'c.impuesto', 'c.estado', 'c.total_credito')
        -> where('c.num_comprobante','LIKE','%'.$querry.'%')         
        -> orderBy('c.id', 'asc')
        -> groupBy('c.id', 'c.fecha_hora', 'a.codigo', 'a.monto_actual', 'c.tipo_comprobante', 'c.serie_comprobante', 'c.num_comprobante', 'c.impuesto', 'c.estado')
        -> paginate(7);
        
        return view('credito.index', ["creditos" => $creditos, "searchText" => $querry]);
      }
    }

    //create (muestra la vista de crear)
    public function create()
    {
       $user_list = User::all();
       $tipofactura_list = TipoFactura::all();
       $tipopago_list = TipoPago::all();
      $autorizaciones = Autorizacion::all();
      $productos = DB::table('productos as prod')      
      -> select(DB::raw('CONCAT (prod.barcode, " - " ,prod.descripcion) as  producto'), 'prod.id', 'prod.stock', 'prod.precio_venta')
      -> where ('prod.estado', '=', 'Activo')
      -> where ('prod.stock' , '>', '0')
      -> get();

      return view('credito.create', ['autorizaciones' => $autorizaciones, 'productos' => $productos, 'user_list' =>$user_list,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list]);
    }

    

    //store(insertar un registro)
    public function store(CreateCreditoRequest $request)
    {
      
    try {

        DB::beginTransaction();

        $credito = new Credito;     
        $credito -> id_autorizacion = $request -> get('id_autorizacion');//este valor es el que se encuentra en el formulario
      $credito -> id_user = $request -> get('id_user');
      $credito -> tipofactura_id = $request -> get('tipofactura_id');
      $credito -> tipopago_id = $request -> get('tipopago_id');
        $credito -> tipo_comprobante = $request -> get('tipo_comprobante');
        $credito -> serie_comprobante = $request -> get('serie_comprobante');
        $credito -> num_comprobante = $request -> get('num_comprobante');
      $credito -> total_credito = $request -> get('total_credito');
      
        $mytime = Carbon::now('America/Argentina/Salta');
        $credito -> fecha_hora = $mytime -> toDateTimeString();
      $credito -> impuesto = '0.21';
      
        
        $credito -> estado = 'Efectuada';     
        $credito -> save();

        $id_producto  = $request -> get('id_producto');
        $cantidad = $request -> get('cantidad');
        $descuento = $request -> get('descuento');
        $precio_venta = $request -> get('precio_venta');

        $cont=0;

        while($cont < count ($id_producto)){

            $detalle = new DetalleCredito();
            $detalle ->id_credito = $credito ->id;
            $detalle -> id_producto = $id_producto[$cont];
            $detalle -> cantidad = $cantidad[$cont];
            $detalle -> descuento = $descuento[$cont];
            $detalle -> precio_venta = $precio_venta[$cont];
            $detalle -> save();
            
            $cont = $cont+1;
        }

        DB::commit();

    } catch (\Exception $e) {
        DB::rollback();
    }

      return Redirect::to('credito');
    }

    //show
    public function show ($id){

        $credito = DB::table('creditos as c') 
        -> join('autorizacion as a','c.id_autorizacion','=','a.id')
        -> join('detalles_creditos as dc','c.id','=','dc.id_credito')
        -> select('c.id', 'c.fecha_hora', 'a.codigo', 'a.monto_actual', 'c.tipo_comprobante', 'c.serie_comprobante', 'c.num_comprobante', 'c.impuesto', 'c.estado', 'c.total_credito')
        -> where ('c.id','=', $id)
        -> first();


        $detalles = DB::table('detalles_creditos as d') 
         -> join('productos as prod','d.id_producto','=','prod.id')
         -> select('prod.descripcion as producto', 'd.cantidad', 'd.descuento', 'd.precio_venta')
         -> where ('d.id_credito', '=', $id) -> get();

         return view('credito.show', ['credito' => $credito, 'detalles' => $detalles]);
    }


        public function pdf(Request $request,$id){
        $credito = Credito::join('autorizacion','creditos.id_autorizacion','=','autorizacion.id')
        ->join('users','creditos.id_user','=','users.id')
        ->select('creditos.id','creditos.tipo_comprobante','creditos.serie_comprobante',
        'creditos.num_comprobante','creditos.fecha_hora','creditos.impuesto','creditos.total_credito',
        'creditos.estado','autorizacion.codigo','autorizacion.monto_actual','users.name')
        ->where('creditos.id','=',$id)
        ->orderBy('creditos.id','desc')->take(1)->get();

        $detalles = DetalleCredito::join('productos','detalles_creditos.id_producto','=','productos.id')
        ->select('detalles_creditos.cantidad','detalles_creditos.precio_venta','detalles_creditos.descuento',
        'productos.descripcion as producto')
        ->where('detalles_creditos.id_credito','=',$id)
        ->orderBy('detalles_creditos.id','desc')->get();

        $factura_name= sprintf('comprobante-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('credito.pdf',['credito'=>$credito,'detalles'=>$detalles]);
        return $pdf->download($factura_name);  
      }

    //update (actualizar un registro)
    

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $credito =  Credito::findOrFail($id);
      $credito -> estado = 'Cancelada'; 
      $credito -> update();

      return Redirect::to('credito');
    }

}

