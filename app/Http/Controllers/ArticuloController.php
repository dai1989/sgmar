<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateArticuloRequest;
use App\Models\Articulo;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Flash;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class ArticuloController extends Controller
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
        $articulos = DB::table('articulos as a') 
        -> join('categorias as c', 'a.id_categoria', '=', 'c.id_categoria')
        -> join('marcas as m', 'a.id_marca', '=', 'm.id_marca')
        -> select('a.id_articulo', 'a.descripcion', 'a.barcode', 'a.stock', 'a.precio_venta','c.categoria_descripcion as categoria','m.descripcion as marca', 'a.imagen', 'a.estado')
        -> where('a.descripcion','LIKE','%'.$querry.'%')         
        -> orwhere('a.barcode','LIKE','%'.$querry.'%')         
        -> orderBy('a.id_articulo', 'asc')
        -> paginate(7);
        
        return view('almacen.articulo.index', ["articulos" => $articulos, "searchText" => $querry]);
      }
    }


    //create (mostra la vista de crear)
    public function create()
    {
      $categorias = DB::table('categorias') -> where('status', '=', '1') -> get();
      $marcas = DB::table('marcas') -> where('status', '=', '1') -> get();
    	return view('almacen.articulo.create', ["categorias" => $categorias,"marcas"=>$marcas]);
    }

    //show (mostrar la vista de show)
    public function show($id)
    {
    	return view ('almacen.articulo.show', ['articulo' => Articulo::findOrFail($id)]);
    }

    //edit (mostrar la vista de editar)
    public function edit($id)
    {

      $articulo = Articulo::findOrFail($id);
      $categorias = DB::table('categorias') -> where('status', '=', '1') -> get();
      $marcas = DB::table('marcas') -> where('status', '=', '1') -> get();

    	return view ('almacen.articulo.edit', ['articulo' => $articulo, 'categorias' => $categorias,'marcas'=>$marcas]);
    }

    //store(insertar un registro)
    public function store(CreateArticuloRequest $request)
    {
    	//creamos un objeto del tipo categoria
    	$articulo = new Articulo;
      $articulo -> id_categoria = $request -> get('id_categoria');//este valor es el que se encuentra en el formulario
    	$articulo -> id_marca = $request -> get('id_marca');//este valor es el que se encuentra en el formulario
    	$articulo -> barcode = $request -> get('barcode');
      $articulo -> descripcion = $request -> get('descripcion');
      $articulo -> stock = $request -> get('stock');
      $articulo -> precio_venta = $request -> get('precio_venta');
      
    	$articulo -> estado = 'Activo';

      //revisar si hay imagen y subirla al server
      if(Input::hasFile('imagen'))
      {
        $file = Input::file('imagen');
        $file -> move(public_path().'/imagenes/productos', $file -> getClientOriginalName());
        $articulo -> imagen = $file -> getClientOriginalName();
      }

    	$articulo -> save();
      Flash::success('Producto saved successfully.');

    	return Redirect::to('almacen/articulo');
    }

    //update (actualizar un registro)
   	public function update(CreateArticuloRequest $request, $id)
   	{
   	
   		$articulo = Articulo::findOrFail($id);
      $articulo -> id_categoria = $request -> get('id_categoria');//este valor es el que se encuentra en el formulario
   		$articulo -> id_marca = $request -> get('id_marca');//este valor es el que se encuentra en el formulario
      $articulo -> barcode = $request -> get('barcode');
      $articulo -> descripcion = $request -> get('descripcion');
      $articulo -> stock = $request -> get('stock');
      $articulo -> precio_venta = $request -> get('precio_venta');
      
      $articulo -> estado = 'Activo';

      //revisar si hay imagen y subirla al server
      if(Input::hasFile('imagen'))
      {
        $file = Input::file('imagen');
        $file -> move(public_path().'/imagenes/productos', $file -> getClientOriginalName());
        $articulo -> imagen = $file -> getClientOriginalName();
      }
   		$articulo -> update(); 

   		return Redirect::to('almacen/articulo');
   	}

   	//destroy (eliminar logicamente un registro)
   	public function destroy($id)
   	{
   		$articulo = Articulo::findOrFail($id);
   		$articulo -> estado = 'Inactivo';
   		$articulo -> update();

   		return Redirect::to('almacen/articulo');
   	}

    

}
