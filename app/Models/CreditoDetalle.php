<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditoDetalle extends Model
{
     protected $table = 'credito_detalles';

    public function producto(){
        return $this->belongsTo('App\Models\Producto');
    }
}
