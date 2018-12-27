<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    //
    protected $table = 'detalles_ingresos';
    
    protected $primaryKey= 'id';

    public $timestamps = false;

    protected $fillable = [
    	'id_ingreso',
    	'id_producto',
    	'cantidad',
        'precio_compra',        
    	'precio_venta'     	
    ];

    protected $guarded = [

    	
    ];

}
