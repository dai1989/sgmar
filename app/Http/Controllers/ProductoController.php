<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateProductoRequest;
use App\Models\Producto;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Flash;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class ProductoController extends Controller
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
        $productos = DB::table('productos as prod') 
        -> join('categorias as c', 'prod.id_categoria', '=', 'c.id_categoria')
        -> join('marcas as m', 'prod.id_marca', '=', 'm.id_marca')
        -> select('prod.id_producto', 'prod.descripcion', 'prod.barcode', 'prod.stock', 'prod.precio_venta','c.categoria_descripcion as categoria','m.descripcion as marca', 'prod.imagen', 'prod.estado')
        -> where('prod.descripcion','LIKE','%'.$querry.'%')         
        -> orwhere('prod.barcode','LIKE','%'.$querry.'%')         
        -> orderBy('prod.id_producto', 'asc')
        -> paginate(7);
        
        return view('producto.index', ["productos" => $productos, "searchText" => $querry]);
      }
    }


    //create (mostra la vista de crear)
    public function create()
    {
      $categorias = DB::table('categorias') -> where('status', '=', '1') -> get();
      $marcas = DB::table('marcas') -> where('status', '=', '1') -> get();
      return view('producto.create', ["categorias" => $categorias,"marcas"=>$marcas]);
    }

    //show (mostrar la vista de show)
    public function show($id)
    {
      return view ('producto.show', ['producto' => Producto::findOrFail($id)]);
    }

    //edit (mostrar la vista de editar)
    public function edit($id)
    {

      $producto = Producto::findOrFail($id);
      $categorias = DB::table('categorias') -> where('status', '=', '1') -> get();
      $marcas = DB::table('marcas') -> where('status', '=', '1') -> get();

      return view ('producto.edit', ['producto' => $producto, 'categorias' => $categorias,'marcas'=>$marcas]);
    }

    //store(insertar un registro)
    public function store(CreateProductoRequest $request)
    {
      //creamos un objeto del tipo categoria
      $producto = new Producto;
      $producto -> id_categoria = $request -> get('id_categoria');//este valor es el que se encuentra en el formulario
      $producto -> id_marca = $request -> get('id_marca');//este valor es el que se encuentra en el formulario
      $producto -> barcode = $request -> get('barcode');
      $producto -> descripcion = $request -> get('descripcion');
      $producto -> stock = $request -> get('stock');
      $producto -> precio_venta = $request -> get('precio_venta');
      
      $producto -> estado = 'Activo';

      //revisar si hay imagen y subirla al server
      if(Input::hasFile('imagen'))
      {
        $file = Input::file('imagen');
        $file -> move(public_path().'/imagenes/productos', $file -> getClientOriginalName());
        $producto -> imagen = $file -> getClientOriginalName();
      }

      $producto -> save();
      Flash::success('Producto saved successfully.');

      return Redirect::to('producto');
    }

    //update (actualizar un registro)
    public function update(CreateProductoRequest $request, $id)
    {
    
      $producto = Producto::findOrFail($id);
      $producto -> id_categoria = $request -> get('id_categoria');//este valor es el que se encuentra en el formulario
      $producto -> id_marca = $request -> get('id_marca');//este valor es el que se encuentra en el formulario
      $producto -> barcode = $request -> get('barcode');
      $producto -> descripcion = $request -> get('descripcion');
      $producto -> stock = $request -> get('stock');
      $producto -> precio_venta = $request -> get('precio_venta');
      
      $producto -> estado = 'Activo';

      //revisar si hay imagen y subirla al server
      if(Input::hasFile('imagen'))
      {
        $file = Input::file('imagen');
        $file -> move(public_path().'/imagenes/productos', $file -> getClientOriginalName());
        $producto -> imagen = $file -> getClientOriginalName();
      }
      $producto -> update(); 

      return Redirect::to('producto');
    }

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $producto = Producto::findOrFail($id);
      $producto -> estado = 'Inactivo';
      $producto -> update();

      return Redirect::to('producto');
    }

    

}
