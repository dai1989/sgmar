<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleFacturaCompra extends Model
{
    protected $table = 'facturacompra_detalles';

    public function obtenerSubTotal()
    {
    	$subtotal = $this->precio_compra * $this->cantidad;
    	return $subtotal;
    }
    public function obtenerIva() 
    {
        $iva = $this->subtotal * 21/100;
        return $iva;
    }

    public function producto()
    {
    	return $this->belongsTo('App\Models\Producto');
    }
}
