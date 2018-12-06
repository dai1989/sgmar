<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
     protected $table = 'devoluciones';
    
    public function detail(){
        return $this->hasMany('App\Models\DevolucionDetalle');
    }
    public function venta(){
        return $this->belongsTo('App\Models\Venta');
    }
    public function tipopago(){
        return $this->belongsTo('App\Models\TipoPago');
    }
     public function tipofactura(){
        return $this->belongsTo('App\Models\TipoFactura');
    }
     public function user()
    {
        return $this->belongsTo('App\User');
    }
}
