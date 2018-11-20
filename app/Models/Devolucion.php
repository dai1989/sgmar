<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
     protected $table = 'devoluciones';
    
    public function detail(){
        return $this->hasMany('App\Models\DevolucionDetalle');
    }
    public function persona(){
        return $this->belongsTo('App\Models\Persona');
    }
    public function factura(){
        return $this->belongsTo('App\Models\Factura');
    }
     public function user()
    {
        return $this->belongsTo('App\User');
    }
}
