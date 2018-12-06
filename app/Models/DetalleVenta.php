<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //
    protected $table = 'detalles_ventas';
    
    protected $primaryKey= 'id';

    public $timestamps = false;

    protected $fillable = [
    	'id_venta',
    	'id_producto',
    	'cantidad',    	
    	'precio_venta',
    	'descuento'    	
    ];

    protected $guarded = [

    	
    ];
}
