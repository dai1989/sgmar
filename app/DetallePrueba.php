<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePrueba extends Model
{
    protected $table = 'prueba_detalles';
    protected $fillable = [
        'idprueba', 
        'idproducto',
        'cantidad',
        'precio'
    ];
    public $timestamps = false;
}
