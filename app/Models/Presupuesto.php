<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
	protected $table = 'presupuesto';
    public function detail(){
        return $this->hasMany('App\Models\PresupuestoDetalle');
    }
    public function persona(){
        return $this->belongsTo('App\Models\Persona');
    }
     public function user()
    {
        return $this->belongsTo('App\User');
    }
}