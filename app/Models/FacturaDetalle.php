<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
     protected $table = 'factura_detalles';

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto');
    }
}
