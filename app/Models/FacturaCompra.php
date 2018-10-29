<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaCompra extends Model
{
	 protected $table = 'factura_compra';
     public function detail ()
     {
        return $this->hasMany('App\Models\FacturaCompraDetalle');
    }

   

    public function persona(){
        return $this->belongsTo('App\Models\Persona');
    }
}
