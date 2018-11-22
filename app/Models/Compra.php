<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
     protected $table = 'compras';
    
    public function detail(){
        return $this->hasMany('App\Models\CompraDetalle');
    }
    public function proveedor(){
        return $this->belongsTo('App\Models\Proveedor');
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
