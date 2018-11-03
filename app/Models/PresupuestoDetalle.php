<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresupuestoDetalle extends Model
 {
    protected $table = 'presupuesto_detalles';

    public function producto(){
        return $this->belongsTo('App\Models\Producto');
    }
}
