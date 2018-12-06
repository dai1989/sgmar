<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevolucionDetalle extends Model
{
     protected $table = 'devolucion_detalles';

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto');
    }
}