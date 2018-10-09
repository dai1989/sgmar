<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacturaCompra;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\DetalleFacturaCompra; 
use App\Models\Stock;
use Barryvdh\DomPDF\Facade as PDF;
use App\User;
use App\Models\TipoPago;

class FacturaCompraController extends Controller
{
    public function index()
    {
        $factura_compra_list = FacturaCompra::all();

        foreach ($factura_compra_list as $factura_compra) {
            $factura_compra->total = $factura_compra->obtenerTotal();
        }


        return view('factura_compra.index', ['factura_compra_list'=>$factura_compra_list]);
    }

    public function create()
    {
      $proveedores_list = Proveedor::all();
      $users_list = User::all();
      $tipopagos_list = TipoPago::all();
    	return view('factura_compra.create', ['proveedores_list'=>$proveedores_list,'users_list'=>$users_list,'tipopagos_list'=>$tipopagos_list]);
    }

    public function store(Request $request)
    {
      $FacturaNumero = $request->input("txtFacturaNumero");
      $FacturaTipo=$request->input("txtFacturaTipo");
      $FacturaFecha= $request->input("txtFacturaFecha");
      
      $proveedor = $request->input("cboProveedor");
      $user = $request->input("cboUser");
      $tipo_pago = $request->input("cboTipoPago");

      // crear nueva factura
      $factura_compra = new FacturaCompra();
      $factura_compra->fac_numero = $FacturaNumero; 
      $factura_compra->fac_tipo = $FacturaTipo;
      $factura_compra->fac_fecha = $FacturaFecha;
      
      $factura_compra->proveedor_id = $proveedor;
      $factura_compra->user_id = $user;
      $factura_compra->tipopago_id = $tipo_pago;
      $factura_compra->save();
      

      $mensaje = "FACTURA CREADA CORRECTAMENTE";
      //return redirect("facturas/create")->with("mensaje", $mensaje);
      return redirect("factura_compra/" . $factura_compra->id . "/detalle/add")->with("mensaje", $mensaje);
    }
   
   public function detalleadd($id)
    {
      $factura_compra = FacturaCompra::find($id);
      $factura_compra->total = $factura_compra->obtenerTotal();

      $productos_list = Producto::all();
      $detalle_list = DetalleFacturaCompra::where('factura_compra_id', $id)->get();

        foreach ($detalle_list as $detalle) {
            $detalle->subtotal = $detalle->obtenerSubTotal();
        }  

        return view( 
            'factura_compra.detalleAdd',
            ['factura_compra'=>$factura_compra, 'productos_list'=>$productos_list, 'detalle_list'=>$detalle_list]
        );
    }

    public function detalleaddstore(Request $request, $factura_compra_id)
    {
        $producto_id = $request->input("cboProducto");
        $cantidad = $request->input("txtCantidad");
        $FacturaPrecioCompra = $request->input("txtFacturaPrecioCompra");
        $stock = Stock::where('producto_id', $producto_id)->first();

        if ($cantidad > $stock->cantidad_actual) {
            $mensaje = "NO CUENTA CON LA CANTIDAD NECESARIA";
            return redirect("factura_compra/" . $factura_compra_id . "/detalle/add")->with("mensaje", $mensaje);
        }

        $stock->cantidad_actual = $stock->cantidad_actual + $cantidad;
        $stock->save();

        $productos = Producto::find($producto_id);
        $factura_compra = FacturaCompra::find($factura_compra_id);

        $detalle = new DetalleFacturaCompra();
        $detalle->factura_compra_id = $factura_compra_id;
        $detalle->producto_id = $producto_id;
        $detalle->cantidad = $cantidad;
        
        $detalle->precio_compra = $FacturaPrecioCompra;
        $detalle->save();

        $mensaje = "PRODUCTO AGREGADO CORRECTAMENTE.";
        return redirect("factura_compra/" . $factura_compra_id . "/detalle/add")->with("mensaje", $mensaje);
    }

    public function detalledelete($detalle_id)
    {
        $detalle = DetalleFacturaCompra::find($detalle_id);
        $factura_compra_id = $detalle->factura_compra_id;
        $producto_id=$detalle->producto_id;
        $cantidad=$detalle->cantidad;
        $stock=Stock::where('producto_id',$producto_id)->first();
        $stock->cantidad_actual=$stock->cantidad_actual-$cantidad;
        $stock->save();
        $detalle->delete();

        $mensaje = "ITEM BORRADO.";
        return redirect("factura_compra/" . $factura_compra_id . "/detalle/add")->with("mensaje", $mensaje);
    }

     public function pdf()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        $detalles = DetalleFacturaCompra::all(); 

        $pdf = PDF::loadView('pdf.detalles', compact('detalles'));

        return $pdf->download('listado.pdf');
    }
}









