<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Producto;
use Illuminate\Http\Request;
use DB;

use App\Presupuesto;
use App\EstadisticasVentas;

use  Carbon\Carbon;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
     public function avisos()
    {
    
      $aviso=DB::table('productos')
                  ->orderBy('stock', 'asc')
                  ->get();

      $estadistica = DB::table('estadistica_venta as es')
       ->join('productos as a','es.id_producto','=','a.id')
       ->limit(7)
       ->get();
      $promedioventa = DB::table('presupuestos')
                    ->orderBy('fecha_hora', 'asc')
                    ->limit(7)
                    ->get();

      return view('index' ,['aviso'=>$aviso, 'estadistica'=>$estadistica, 'promedioventa'=>$promedioventa]);
    }

    public function index()
    {
        return view('adminlte::home');
    }
}