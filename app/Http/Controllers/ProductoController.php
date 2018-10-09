<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Repositories\ProductoRepository;
use App\Repositories\ClienteRepository;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Stock;
use Barryvdh\DomPDF\Facade as PDF;

class ProductoController extends Controller
{
    /** @var  ProductoRepository */
    private $productoRepository;

    public function __construct(ProductoRepository $productoRepo)
    {
        $this->productoRepository = $productoRepo;
    }

    /**
     * Display a listing of the Producto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $productos= Producto::all(); 

        return view('productos.index',["productos"=>$productos]);
            

    }

    /**
     * Show the form for creating a new Producto.
     *
     * @return Response
     */
    public function create()
    {
      $marca_list = Marca::all();
      $categoria_list = Categoria::all();
      return view("productos.create", ["marca_list"=>$marca_list,"categoria_list"=>$categoria_list]);
        
    }

    /**
     * Store a newly created Producto in storage.
     *
     * @param CreateProductoRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
     
      $descripcion = $request->input ("Descripcion");
      $precio_venta = $request->input("PrecioVenta");
      $stock = $request->input("stock");
      $barcode = $request->input("barcode");
      $marca = $request->input("Marca");
      $categoria = $request->input("Categoria");

      request()->validate ([
          
          'Descripcion' => 'required',
          'PrecioVenta' => 'required',
          'stock' => 'required',
          'Marca' => 'required',
          'Categoria' => 'required',
          'barcode' => 'required',

        ]);

      $producto = new Producto ();
    
      $producto->descripcion =$descripcion;
      $producto->precio_venta =$precio_venta; 
      $producto->stock =$stock; 
      $producto->barcode =$barcode; 
      $producto->marca_id = $marca;
      $producto->categoria_id = $categoria;
      $producto-> save();
        //crear stock del producto
      $stock = new Stock();
      $stock->producto_id = $producto->id;
      //$stock->cantidad_actual = 0;
      //$stock->cantidad_minima = 0;
      $stock->save();

    

      Flash::success('Producto saved successfully.');
      return redirect(route('productos.index'));
    }

    /**
     * Display the specified Producto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $producto = $this->productoRepository->findWithoutFail($id);

        if (empty($producto)) {
            Flash::error('Producto not found');

            return redirect(route('productos.index'));
        }

        return view('productos.show')->with('producto', $producto);
    }

    /**
     * Show the form for editing the specified Producto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $productos =Producto::find($id);
      $marca_list = Marca::all();
      $categoria_list = Categoria::all();
      
        return view ("productos.edit",["productos"=>$productos,"marca_list"=>$marca_list,"categoria_list"=>$categoria_list]);
        
    }

    /**
     * Update the specified Producto in storage.
     *
     * @param  int              $id
     * @param UpdateProductoRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        //obtener datos del formulario.
     
      $descripcion = $request->input ("Descripcion");
      $precio_venta = $request->input("PrecioVenta");
      $stock = $request->input("stock");
      $barcode = $request->input("barcode");
      $marca = $request->input("Marca");
      $categoria = $request->input("Categoria");
     
      

      //obtener el cliente a modificar
      $productos = Producto::find($id);
      
      $productos->descripcion =$descripcion;
      $productos->precio_venta =$precio_venta;
      $productos->stock =$stock;
      $producto->barcode =$barcode; 
      $productos->marca_id = $marca;
      $productos->categoria_id = $categoria;
      $productos-> save();

      Flash::success('Producto updated successfully.');

        return redirect(route('productos.index'));
    }

    /**
     * Remove the specified Producto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productos = Producto::find($id);
        
        $productos->delete();
        
        
        

        Flash::success('Producto deleted successfully.');

        return redirect(route('productos.index'));
    }
}
