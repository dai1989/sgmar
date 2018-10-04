<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Producto;


class StockController extends Controller
{
    public function index()
    {
        /*$stock_list = Stock::all();
        return view('stock.index', ["stock_list" => $stock_list]);*/
         $stock_list = Stock::latest()->paginate(5);
        return view('stock.index', compact('stock_list'))->with('i',(request()->input('page',1) -1) *5);
    }

  

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $stock = Stock::find($id);
        return view('stock.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $stock = Stock::find($id);
        return view('stock.edit', compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // obtener datos enviados desde formulario
        $cantidadMinima = $request->input("txtCantidadMinima");
        $cantidadActual = $request->input("txtCantidadActual");

       // validacion
        if ($cantidadActual < $cantidadMinima) {
            $mensaje = "CANTIDAD ACTUAL DEBE SER MAYOR O IGUAL A MINIMA";
            return redirect("stock/" . $id . "/edit")->with('success','Stock actualizado exitosamente',"mensaje", $mensaje);
        }
     

     // obtener el stock
        $stock = Stock::find($id);
        $stock->cantidad_minima = $cantidadMinima;
        $stock->cantidad_actual = $cantidadActual;
        $stock->save();

        $mensaje = "STOCK ACTUALIZADO!";
        return redirect("stock/" . $id . "/edit")->with("mensaje", $mensaje);
    }
}


