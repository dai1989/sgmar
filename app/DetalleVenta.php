<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
	protected $table='detalle_venta';

    protected $primaryKey='iddetalle_venta';

    protected $fillable=[
    	'idventa',
    	'idproducto',
    	'cantidad',
    	'precio_venta',
    	'descuento'
    ];
}
