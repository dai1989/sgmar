<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuentaCte extends Model
 {
    public function detail(){
        return $this->hasMany('App\Models\CuentaCteDetalle');
    }
    public function persona(){
        return $this->belongsTo('App\Models\Persona');
    }
     public function user()
    {
        return $this->belongsTo('App\User');
    }
}