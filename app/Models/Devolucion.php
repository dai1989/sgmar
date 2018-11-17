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
    public function invoice(){
        return $this->belongsTo('App\Invoice');
    }
     public function user()
    {
        return $this->belongsTo('App\User');
    }
}
