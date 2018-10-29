<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaCompraDetalle extends Model
{
    protected $table = 'facturacompra_detalles';

    public function producto(){
        return $this->belongsTo('App\Models\Producto');
    }
}












