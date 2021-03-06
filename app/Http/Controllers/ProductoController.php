<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ProductoDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateProductoRequest;
use App\Models\Producto;
use App\Models\Marca;
use App\Models\Categoria;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Flash;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DNS1D;
class ProductoController extends Controller
{
    

  //contructor
    public function __construct()
    {
        $this -> middleware('auth');
    }

    //index 
    public function index(ProductoDataTable $productoDataTable)
    {
        return $productoDataTable->render('producto.index');
    }


    //create (mostra la vista de crear)
    public function create()
    {
      $categorias = Categoria::all();
      $marcas = Marca::all();
      
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
      $categorias = Categoria::all();
      $marcas = Marca::all();

      return view ('producto.edit', ['producto' => $producto, 'categorias' => $categorias,'marcas'=>$marcas]);
    }

    //store(insertar un registro)
    public function store(CreateProductoRequest $request)
    {
      //creamos un objeto del tipo categoria
      $producto = new Producto;
      $producto -> categoria_id = $request -> get('categoria_id');//este valor es el que se encuentra en el formulario
      $producto -> marca_id = $request -> get('marca_id');//este valor es el que se encuentra en el formulario
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
      Flash::success('Producto guardado exitosamente.');

      return Redirect::to('producto');
    }

    //update (actualizar un registro)
    public function update(Request $request, $id)
    {
    
      $producto = Producto::findOrFail($id);
      $producto -> categoria_id = $request -> get('categoria_id');//este valor es el que se encuentra en el formulario
      $producto -> marca_id = $request -> get('marca_id');//este valor es el que se encuentra en el formulario
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
