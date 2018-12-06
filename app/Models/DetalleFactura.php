<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
     protected $table = 'detalle_facturas';

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto');
    }
}
