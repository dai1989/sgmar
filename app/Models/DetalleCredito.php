<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCredito extends Model
{
    //
    protected $table = 'detalles_creditos';
    
    protected $primaryKey= 'id';

    public $timestamps = false;

    protected $fillable = [
    	'id_credito',
    	'id_producto',
    	'cantidad',
    	'precio_venta'      	
    ];

    protected $guarded = [

    	
    ];

}
