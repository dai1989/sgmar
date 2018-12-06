<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $table = 'productos';
    
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
