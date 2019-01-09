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
use App\Models\DetalleVenta;
use App\User;
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
      -> select(DB::raw('CONCAT (prod.barcode, " - " ,prod.descripcion) as  producto'), 'prod.id', 'prod.stock', 'prod.precio_venta')
      -> where ('prod.estado', '=', 'Activo')
      -> where ('prod.stock' , '>', '0')
      -> get(); 

      return view('venta.create', ['personas' => $personas, 'productos' => $productos, 'user_list' =>$user_list,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list,'idventa'=>$idventa]);
    }

    

    //store(insertar un registro)
    public function store(CreateVentaRequest $request)
    {
      
    try {

    	DB::beginTransaction();

		  $venta = new Venta;	    
	    $venta->persona_id = $request -> get('persona_id');//este valor es el que se encuentra en el formulario
      $venta -> user_id = $request -> get('user_id');
      $venta -> tipofactura_id = $request -> get('tipofactura_id');
      $venta -> tipopago_id = $request -> get('tipopago_id');
	    $venta -> tipo_comprobante = $request -> get('tipo_comprobante');
	    
	    $venta -> num_comprobante = $request -> get('num_comprobante');
      $venta -> total_venta = $request -> get('total_venta');
      $venta -> entrega = $request -> get('entrega');
	    $mytime = Carbon::now('America/Argentina/Salta');
	    $venta -> fecha_hora = $mytime -> toDateTimeString();
      $venta -> impuesto = '0.21';
      
	    
	    $venta -> estado = 'Efectuada';	    
	    $venta -> save();

	    $id_producto  = $request -> get('id_producto');
	    $cantidad = $request -> get('cantidad');
	    $descuento = $request -> get('descuento');
	    $precio_venta = $request -> get('precio_venta');

	    $cont=0;

	    while($cont < count ($id_producto)){

	    	$detalle = new DetalleVenta();
	    	$detalle ->id_venta = $venta ->id;
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
     $venta= Venta::all()->last(); 
    
      Flash::success('Su venta, del día '.$venta->fecha_hora=$mytime->format('d-m-Y').' ha sido creada correctamente')->important();
      return Redirect::to('venta');
    }

    //show
    public function show ($id){

    	$venta = DB::table('ventas as v') 
        -> join('personas as p','v.persona_id','=','p.id')
        -> join('detalles_ventas as dv','v.id','=','dv.id_venta')
        -> select('v.id', 'v.fecha_hora', 'p.nombre', 'p.apellido', 'v.tipo_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta','v.entrega')
        -> where ('v.id','=', $id)
        -> first();


        $detalles = DB::table('detalles_ventas as d') 
         -> join('productos as prod','d.id_producto','=','prod.id')
         -> select('prod.descripcion as producto', 'd.cantidad', 'd.descuento', 'd.precio_venta')
         -> where ('d.id_venta', '=', $id) -> get();

         return view('venta.show', ['venta' => $venta, 'detalles' => $detalles]);
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
      $venta =  Venta::findOrFail($id);
      $venta -> estado = 'Cancelada'; 
      $venta -> update();

      return Redirect::to('venta');
    }

}

