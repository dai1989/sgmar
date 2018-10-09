<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaCompra extends Model
{
    protected $table = 'factura_compra';  

    public function obtenerTotal()  
    {
    	$detalle_list = DetalleFacturaCompra::where('factura_compra_id', $this->id)->get();
    	$total = 0;
        $iva = 0;
    	foreach ($detalle_list as $detalle) {
    		$subtotal = $detalle->precio_compra * $detalle->cantidad;
            $iva = $subtotal * 21 / 100;
    	    $total = $total + $subtotal + $iva;
    	}
    	return $total;
    }

    public function proveedor()
    {
    	return $this->belongsTo('App\Models\Proveedor');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
