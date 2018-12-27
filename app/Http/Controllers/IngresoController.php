<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateIngresoRequest;

use App\Models\Ingreso;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\DetalleIngreso;
use App\User;
use App\Models\TipoPago;
use App\Models\TipoFactura;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection; 

class IngresoController extends Controller
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
        $ingresos = DB::table('ingresos as i') 
        -> join('proveedores as p','i.id_proveedor','=','p.id')
        -> join('detalles_ingresos as di','i.id','=','di.id_ingreso')
        -> select('i.id', 'i.fecha_hora', 'p.razonsocial','p.cuit', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total_compra'))
        -> where('i.num_comprobante','LIKE','%'.$querry.'%')         
        -> orderBy('i.id', 'asc')
        -> groupBy('i.id', 'i.fecha_hora', 'p.razonsocial','i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado')
        -> paginate(7);
        
        return view('ingreso.index', ["ingresos" => $ingresos, "searchText" => $querry]);
      }
    }

    //create (mostra la vista de crear)
    public function create()
    {
       $iingreso=DB::table('ingresos')->max('id')+1;
       $user_list = User::all();
       $tipofactura_list = TipoFactura::all();
       $tipopago_list = TipoPago::all();
      $proveedores = Proveedor::all();
      $productos = DB::table('productos as prod')
      -> select(DB::raw('CONCAT (prod.barcode, " - " ,prod.descripcion) as  producto'), 'prod.id')
      -> where ('prod.estado', '=', 'Activo')
      -> get();

      return view('ingreso.create', ['proveedores' => $proveedores, 'productos' => $productos,'user_list'=>$user_list,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list,"iingreso"=>$iingreso]);
    }

    // //show (mostrar la vista de show)
    // public function show($id)
    // {
    //   return view ('compras.proveedor.show', ['persona' => Persona::findOrFail($id)]);
    // }

    // //edit (mostrar la vista de editar)
    // public function edit($id)
    // {
    //   return view ('compras.proveedor.edit', ['persona' => Persona::findOrFail($id)]);
    // }

    //store(insertar un registro)
    public function store(CreateIngresoRequest $request)
    {
      
    try {

        DB::beginTransaction();

        $ingreso = new Ingreso;     
        $ingreso -> id_proveedor = $request -> get('id_proveedor');//este valor es el que se encuentra en el formulario
        $ingreso -> id_user = $request -> get('id_user');
        $ingreso -> tipofactura_id = $request -> get('tipofactura_id');
        $ingreso -> tipopago_id = $request -> get('tipopago_id');
        $ingreso -> tipo_comprobante = $request -> get('tipo_comprobante');
        $ingreso -> serie_comprobante = $request -> get('serie_comprobante');
        $ingreso -> num_comprobante = $request -> get('num_comprobante');
        $mytime = Carbon::now('America/Argentina/Salta');
        $ingreso -> fecha_hora = $mytime -> toDateTimeString();
        $ingreso -> impuesto = '0.21';
        $ingreso -> estado = 'Aceptado';        
        $ingreso -> save();

        $id_producto  = $request -> get('id_producto');
        $cantidad = $request -> get('cantidad');
        $precio_compra = $request -> get('precio_compra');
        $precio_venta=$request->get('precio_venta');

        $cont=0;

        while($cont < count ($id_producto)){

            $detalle = new DetalleIngreso();
            $detalle ->id_ingreso = $ingreso ->id;
            $detalle -> id_producto = $id_producto[$cont];
            $detalle -> cantidad = $cantidad[$cont];
            $detalle -> precio_compra = $precio_compra[$cont];
            $detalle -> precio_venta = $precio_venta[$cont];
            $detalle -> save();
            
            $cont = $cont+1;
        }

        DB::commit();

    } catch (\Exception $e) {
        DB::rollback();
    }

      return Redirect::to('ingreso'); 
    }

    //show
    public function show ($id){

        $ingreso = DB::table('ingresos as i') 
        -> join('proveedores as p','i.id_proveedor','=','p.id')
        -> join('detalles_ingresos as di','i.id','=','di.id_ingreso')
        -> select('i.id', 'i.fecha_hora', 'p.razonsocial', 'p.cuit','i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total_compra'))
        -> where ('i.id','=', $id)
        -> first();


        $detalles = DB::table('detalles_ingresos as d') 
         -> join('productos as prod','d.id_producto','=','prod.id')
         -> select('prod.descripcion as producto', 'd.cantidad', 'd.precio_compra','d.precio_venta')
         -> where ('d.id_ingreso', '=', $id) -> get();

         return view('ingreso.show', ['ingreso' => $ingreso, 'detalles' => $detalles]);
    }

    //update (actualizar un registro)
    

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $ingreso = Ingreso::findOrFail($id);
      $ingreso -> estado = 'Cancelado'; 
      $ingreso -> update();

      return Redirect::to('ingreso');
    }

       public function pdf(Request $request,$id){
        $ingreso = Ingreso::join('proveedores','ingresos.id_proveedor','=','proveedores.id')
        ->join('users','ingresos.id_user','=','users.id')
        ->select('ingresos.id','ingresos.tipo_comprobante','ingresos.serie_comprobante',
        'ingresos.num_comprobante','ingresos.fecha_hora','ingresos.impuesto','ingresos.total_compra',
        'ingresos.estado','proveedores.razonsocial','proveedores.cuit','users.name')
        ->where('ingresos.id','=',$id)
        ->orderBy('ingresos.id','desc')->take(1)->get();

        $detalles = DetalleIngreso::join('productos','detalles_ingresos.id_producto','=','productos.id')
        ->select('detalles_ingresos.cantidad','detalles_ingresos.precio_compra','detalles_ingresos.descuento',
        'productos.descripcion as producto')
        ->where('detalles_ingresos.id_ingreso','=',$id)
        ->orderBy('detalles_ingresos.id','desc')->get();

        $factura_name= sprintf('comprobante-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('ingreso.pdf',['ingreso'=>$ingreso,'detalles'=>$detalles]);
        return $pdf->download($factura_name);  
      }


}
