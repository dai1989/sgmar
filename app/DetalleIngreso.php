<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table='detalle_ingreso';

    protected $primaryKey='iddetalle_ingreso';

    protected $fillable=[
    	'idingreso',
    	'idproducto',
    	'cantidad',
    	'precio_compra',
    	'precio_venta'
    ];
}
