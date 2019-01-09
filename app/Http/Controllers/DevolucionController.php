<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateDevolucionRequest;
use App\DataTables\DevolucionDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\Models\Venta;
use App\Models\Devolucion;
use App\Models\Producto;
use App\Models\Persona;
use App\Models\DetalleVenta;
use App\Models\DevolucionDetalle;
use App\User;
use App\Models\TipoPago;
use App\Models\TipoFactura;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
class DevolucionController extends Controller
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
        //obtener las categorias
        $devoluciones = DB::table('devoluciones as dev') 
        -> join('personas as p','dev.id_cliente','=','p.id')
        -> join('devolucion_detalles as dd','dev.id','=','dd.id_devolucion')
        -> select('dev.id', 'dev.fecha_hora', 'p.nombre', 'p.apellido', 'dev.tipo_comprobante', 'dev.serie_comprobante', 'dev.num_comprobante', 'dev.impuesto', 'dev.estado', 'dev.total_devolucion')
        -> where('dev.num_comprobante','LIKE','%'.$querry.'%')         
        -> orderBy('dev.id', 'asc')
        -> groupBy('dev.id', 'dev.fecha_hora', 'p.nombre', 'p.apellido', 'dev.tipo_comprobante', 'dev.serie_comprobante', 'dev.num_comprobante', 'dev.impuesto', 'dev.estado')
        -> paginate(7);
        
        return view('devolucion.index', ["devoluciones" => $devoluciones, "searchText" => $querry]);
      }
    }

    //create (muestra la vista de crear)
    public function create()
    {
       $iddevolucion=DB::table('devoluciones')->max('id')+1;
       $user_list = User::all();
       $tipofactura_list = TipoFactura::all();
       $tipopago_list = TipoPago::all();
      $personas = Persona::all();
      $detalleventas_list = DetalleVenta::all();
      
      $productos = DB::table('productos as prod')      
      -> select(DB::raw('CONCAT (prod.barcode, " - " ,prod.descripcion) as  producto'), 'prod.id', 'prod.stock', 'prod.precio_venta')
      -> where ('prod.estado', '=', 'Activo')
      -> where ('prod.stock' , '>', '0')
      -> get(); 

      return view('devolucion.create', ['personas' => $personas, 'productos' => $productos, 'user_list' =>$user_list,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list,'iddevolucion'=>$iddevolucion,'detalleventas_list'=>$detalleventas_list]);
    }

    

    //store(insertar un registro)
    public function store(CreateDevolucionRequest $request)
    {
      
    try {

        DB::beginTransaction();

          $devolucion = new Devolucion;       
        $devolucion->persona_id = $request -> get('persona_id');//este valor es el que se encuentra en el formulario
        $devolucion->id_detalleventas = $request -> get('id_detalleventas');//este valor es el que se encuentra en el formulario
      $devolucion -> user_id = $request -> get('user_id');
      $devolucion -> tipofactura_id = $request -> get('tipofactura_id');
      $devolucion -> tipopago_id = $request -> get('tipopago_id');
        $devolucion -> tipo_comprobante = $request -> get('tipo_comprobante');
        
        $devolucion -> num_comprobante = $request -> get('num_comprobante');
      $devolucion -> total_devolucion = $request -> get('total_devolucion');
      
        $mytime = Carbon::now('America/Argentina/Salta');
        $devolucion -> fecha_hora = $mytime -> toDateTimeString();
      $devolucion -> impuesto = '0.21';
      
        
        $devolucion -> estado = 'Efectuada';     
        $devolucion -> save();

        $id_producto  = $request -> get('id_producto');
        $cantidad = $request -> get('cantidad');
        
        $precio_venta = $request -> get('precio_venta');

        $cont=0;

        while($cont < count ($id_producto)){

            $detalle = new DevolucionDetalle();
            $detalle ->id_devolucion = $devolucion ->id;
            $detalle -> id_producto = $id_producto[$cont];
            $detalle -> cantidad = $cantidad[$cont];
            
            $detalle -> precio_venta = $precio_venta[$cont];
            $detalle -> save();
            
            $cont = $cont+1;
        }

        DB::commit();

    } catch (\Exception $e) {
        DB::rollback();
    }

      return Redirect::to('devolucion');
    }

    //show
    public function show ($id){

        $devolucion = DB::table('devoluciones as dev') 
        -> join('personas as p','dev.persona_id','=','p.id')
        -> join('devolucion_detalles as dd','dev.id','=','dd.id_devolucion')
        -> select('dev.id', 'dev.fecha_hora', 'p.nombre', 'p.apellido', 'dev.tipo_comprobante', 'dev.num_comprobante', 'dev.impuesto', 'dev.estado', 'dev.total_devolucion')
        -> where ('dev.id','=', $id)
        -> first();


        $detalles = DB::table('devolucion_detalles as d') 
         -> join('productos as prod','d.id_producto','=','prod.id')
         -> select('prod.descripcion as producto', 'd.cantidad', 'd.precio_venta')
         -> where ('d.id_devolucion', '=', $id) -> get();

         return view('devolucion.show', ['devolucion' => $devolucion, 'detalles' => $detalles]);
    }


        public function pdf(Request $request,$id){
         $devolucion = Devolucion::join('personas','devoluciones.persona_id','=','personas.id')
        ->join('users','devoluciones.user_id','=','users.id')
        ->select('devoluciones.id','devoluciones.tipo_comprobante',
        'devoluciones.num_comprobante','devoluciones.fecha_hora','devoluciones.impuesto','devoluciones.total_devolucion',
        'devoluciones.estado','personas.nombre','personas.apellido','personas.documento','personas.tipo_documento','users.name')
        ->where('devoluciones.id','=',$id)
        ->orderBy('devoluciones.id','desc')->take(1)->get();

        $detalles = DevolucionDetalle::join('productos','devolucion_detalles.id_producto','=','productos.id')
        ->select('devolucion_detalles.cantidad','devolucion_detalles.precio_venta',
        'productos.descripcion as producto')
        ->where('devolucion_detalles.id_venta','=',$id)
        ->orderBy('devolucion_detalles.id','desc')->get();

        $factura_name= sprintf('devolucion-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('devolucion.pdf',['devolucion'=>$devolucion,'detalles'=>$detalles]);
        return $pdf->download($factura_name);  
      }

    //update (actualizar un registro)
    

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $devolucion =  Devolucion::findOrFail($id);
      $devolucion -> estado = 'Cancelada'; 
      $devolucion -> update();

      return Redirect::to('devolucion');
    }

}

