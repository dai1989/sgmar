<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Prueba;
use App\DetallePrueba;
use App\User;
 
 
class PruebaController extends Controller
{
    public function index(Request $request)
    {
       if ($request->ajax()) {
           $pruebas = Prueba::all();
           return response ()->json($pruebas,200);
       }
       return view ('prueba.index');
    }
    public function obtenerCabecera(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;
         

        $prueba = Prueba::join('personas','pruebas.idproveedor','=','personas.id')
        ->join('users','pruebas.idusuario','=','users.id')
        ->select('pruebas.id','pruebas.tipo_comprobante','pruebas.serie_comprobante',
        'pruebas.num_comprobante','pruebas.fecha_hora','pruebas.impuesto','pruebas.total',
        'pruebas.estado','personas.nombre','users.usuario')
        ->where('pruebas.id','=',$id)
        ->orderBy('pruebas.id', 'desc')->take(1)->get();

         
        return [
           
            'prueba' => $prueba
        ];
    }
    public function obtenerDetalles(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;
         
        $detalles = DetallePrueba::join('productos','prueba_detalles.idproducto','=','productos.id')
        ->select('prueba_detalles.cantidad','prueba_detalles.precio','productos.nombre as producto')
        ->where('prueba_detalles.idprueba','=',$id)
        ->orderBy('prueba_detalles.id', 'desc')->get();

         
        return [
           
            'detalles' => $detalles
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
 
            $mytime= Carbon::now('America/Lima');
 
            $prueba = new Prueba();
            $prueba->idproveedor = $request->idproveedor;
            $prueba->idusuario = \Auth::user()->id;
            $prueba->tipo_comprobante = $request->tipo_comprobante;
            $prueba->serie_comprobante = $request->serie_comprobante;
            $prueba->num_comprobante = $request->num_comprobante;
            $prueba->fecha_hora = $mytime->toDateString();
            $prueba->impuesto = $request->impuesto;
            $prueba->total = $request->total;
            $prueba->estado = 'Registrado';
            $prueba->save();
 
            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos
 
            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetallePrueba();
                $detalle->idprueba = $prueba->id;
                $detalle->idproducto = $det['idproducto'];
                $detalle->cantidad = $det['cantidad'];
                $detalle->precio = $det['precio'];          
                $detalle->save();
            }          
            $fechaActual= date('Y-m-d');
            $numVentas = DB::table('ventas')->whereDate('created_at', $fechaActual)->count();
            $numPruebas = DB::table('pruebas')->whereDate('created_at', $fechaActual)->count();

            $arregloDatos = [
                'ventas' => [
                            'numero' => $numVentas,
                            'msj' => 'Ventas'
                        ],
                'pruebas' => [
                            'numero' => $numPruebas,
                            'msj' => 'Pruebas'
                ]
            ];
            $allUsers = User::all();

            foreach ($allUsers as $notificar){
                User::findOrFail($notificar->id)->notify(new NotifyAdmin($arregloDatos));
            }

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $prueba = Prueba::findOrFail($request->id);
        $prueba->estado = 'Anulado';
        $prueba->save();
    }
}