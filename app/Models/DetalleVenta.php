<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //
    protected $table = 'detalles_ventas';
    
    protected $primaryKey= 'iddetalle_venta';

    public $timestamps = false;

    protected $fillable = [
    	'idventa',
    	'idproducto',
    	'cantidad',    	
    	'precio_venta',
    	'descuento'    	
    ];

    protected $guarded = [

    	
    ];
}
