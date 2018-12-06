<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //
    protected $table = 'articulos';
    
    protected $primaryKey= 'id';

    public $timestamps = false;

    protected $fillable = [
        'id_categoria',
    	'id_marca',
    	'barcode',
    	'descripcion',
    	'stock',
        'precio_venta',
    	'imagen',
    	'estado'
    ];

    protected $guarded = [

    	
    ];
}
