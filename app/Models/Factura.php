<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
     protected $table = 'facturas';
    
    public function detail(){
        return $this->hasMany('App\Models\FacturaDetalle');
    }
    public function persona(){
        return $this->belongsTo('App\Models\Persona');
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
