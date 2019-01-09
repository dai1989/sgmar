<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevolucionDetalle extends Model
{
	  //
     protected $table = 'devolucion_detalles'; 
    
    protected $primaryKey= 'id';

    public $timestamps = false;

    protected $fillable = [
    	'id_devolucion',
    	'id_producto',
    	'cantidad',    	
    	'precio_venta',
    	'descuento'    	
    ];

    protected $guarded = [

    	
    ];
    

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto');
    }
}