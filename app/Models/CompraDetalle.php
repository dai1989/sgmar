<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
      protected $table = 'compra_detalles';

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto');
    }
}
