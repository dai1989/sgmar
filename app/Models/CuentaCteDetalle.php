<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuentaCteDetalle extends Model
{
    protected $table = 'cuentacte_detalles';

    public function producto(){
        return $this->belongsTo('App\Models\Producto');
    }
}
