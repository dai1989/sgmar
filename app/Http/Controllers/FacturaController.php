<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateFacturaRequest;

use App\Models\Factura;
use App\Models\Producto;
use App\Models\Persona;
use App\Models\DetalleFactura;
use App\User;
use App\Models\TipoPago;
use App\Models\TipoFactura;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class FacturaController extends Controller
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
        $facturas = DB::table('facturas as fa') 
        -> join('personas as p','fa.idcliente','=','p.id')
        -> join('detalle_facturas as df','fa.id','=','df.idfactura')
        -> select('fa.id', 'fa.fecha_hora', 'p.nombre', 'p.apellido', 'fa.tipo_comprobante', 'fa.serie_comprobante', 'fa.num_comprobante', 'fa.impuesto', 'fa.estado', 'fa.total_venta','fa.entrega')
        -> where('fa.num_comprobante','LIKE','%'.$querry.'%')         
        -> orderBy('fa.id', 'asc')
        -> groupBy('fa.id', 'fa.fecha_hora', 'p.nombre', 'p.apellido', 'fa.tipo_comprobante', 'fa.serie_comprobante', 'fa.num_comprobante', 'fa.impuesto', 'fa.estado')
        -> paginate(7);
        
        return view('factura.index', ["facturas" => $facturas, "searchText" => $querry]);
      }
    }

    //create (muestra la vista de crear)
    public function create()
    {
       $user_list = User::all();
       $tipofactura_list = TipoFactura::all();
       $tipopago_list = TipoPago::all();
      $personas = Persona::all();
      $productos = DB::table('productos as prod')      
      -> select(DB::raw('CONCAT (prod.barcode, " - " ,prod.descripcion) as  producto'), 'prod.id', 'prod.stock', 'prod.precio_venta')
      -> where ('prod.estado', '=', 'Activo')
      -> where ('prod.stock' , '>', '0')
      -> get();

      return view('factura.create', ['personas' => $personas, 'productos' => $productos, 'user_list' =>$user_list,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list]);
    }

    

    //store(insertar un registro)
    public function store(CreateFacturaRequest $request)
    {
      
    try {

        DB::beginTransaction();

        $factura = new Factura;     
        $factura -> idcliente = $request -> get('idcliente');//este valor es el que se encuentra en el formulario
      $factura -> id_user = $request -> get('id_user');
      $factura -> tipofactura_id = $request -> get('tipofactura_id');
      $factura -> tipopago_id = $request -> get('tipopago_id');
        $factura -> tipo_comprobante = $request -> get('tipo_comprobante');
        $factura -> serie_comprobante = $request -> get('serie_comprobante');
        $factura -> num_comprobante = $request -> get('num_comprobante');
      $factura -> total_venta = $request -> get('total_venta');
      $factura -> entrega = $request -> get('entrega');
        $mytime = Carbon::now('America/Argentina/Salta');
        $factura -> fecha_hora = $mytime -> toDateTimeString();
      $factura -> impuesto = '0.21';
      
        
        $factura -> estado = 'Efectuada';     
        $factura -> save();

        $idproducto  = $request -> get('idproducto');
        $cantidad = $request -> get('cantidad');
        $descuento = $request -> get('descuento');
        $precio_venta = $request -> get('precio_venta');

        $cont=0;

        while($cont < count ($idproducto)){

            $detalle = new DetalleFactura();
            $detalle -> idfactura = $factura->id;
            $detalle -> idproducto = $idproducto[$cont];
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

      return Redirect::to('factura');
    }

    //show
    public function show ($id){

        $factura = DB::table('facturas as fa') 
        -> join('personas as p','fa.idcliente','=','p.id')
        -> join('detalle_facturas as df','fa.id','=','df.idfactura')
        -> select('fa.id', 'fa.fecha_hora', 'p.nombre', 'p.apellido', 'fa.tipo_comprobante', 'fa.serie_comprobante', 'fa.num_comprobante', 'fa.impuesto', 'fa.estado', 'fa.total_venta','fa.entrega')
        -> where ('fa.id','=', $id)
        -> first();


        $detalles = DB::table('detalle_facturas as d') 
         -> join('productos as a','d.idproducto','=','a.id')
         -> select('a.descripcion as producto', 'd.cantidad', 'd.descuento', 'd.precio_venta')
         -> where ('d.idfactura', '=', $id) -> get();

         return view('factura.show', ['factura' => $factura, 'detalles' => $detalles]);
    }


        public function pdf(Request $request,$id){
        $factura = Venta::join('personas','ventas.id_cliente','=','id')
        ->join('users','ventas.id_user','=','users.id')
        ->select('ventas.id_venta','ventas.tipo_comprobante','ventas.serie_comprobante',
        'ventas.num_comprobante','ventas.fecha_hora','ventas.impuesto','ventas.total_venta',
        'ventas.estado','ventas.entrega','personas.nombre','personas.tipo_documento','personas.documento','users.name')
        ->where('ventas.id_venta','=',$id)
        ->orderBy('ventas.id_venta','desc')->take(1)->get();

        $detalles = DetalleVenta::join('productos','detalles_ventas.id_producto','=','productos.id_producto')
        ->select('detalles_ventas.cantidad','detalles_ventas.precio_venta','detalles_ventas.descuento',
        'productos.descripcion as producto')
        ->where('detalles_ventas.id_venta','=',$id)
        ->orderBy('detalles_ventas.id_detalle_venta','desc')->get();

        $factura_name= sprintf('comprobante-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('ventas/venta.pdf',['venta'=>$venta,'detalles'=>$detalles]);
        return $pdf->download($factura_name);  
      }

    //update (actualizar un registro)
    

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $factura =  Factura::findOrFail($id);
      $factura -> estado = 'Cancelada'; 
      $factura -> update();

      return Redirect::to('factura');
    }

}

