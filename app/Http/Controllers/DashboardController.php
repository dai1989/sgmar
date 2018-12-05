<?php
 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
 
use Illuminate\Http\Request;
 
class DashboardController extends Controller
{
    public function __invoke(Request $request) 
    {
        $anio=date('Y');
      
 
        $ventas=DB::table('ventas as v')
        ->select(DB::raw('MONTH(v.fecha_hora) as mes'),
        DB::raw('YEAR(v.fecha_hora) as anio'),
        DB::raw('SUM(v.total_venta) as total_venta'))
        ->whereYear('v.fecha_hora',$anio)
        ->groupBy(DB::raw('MONTH(v.fecha_hora)'),DB::raw('YEAR(v.fecha_hora)'))
        ->get();
 
        return ['ventas'=>$ventas,'anio'=>$anio];      
 
    }
}