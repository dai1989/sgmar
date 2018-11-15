<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    protected $table = 'creditos';
    public function detail(){
        return $this->hasMany('App\Models\CreditoDetalle');
    }
    public function persona(){
        return $this->belongsTo('App\Models\Persona');
    }
    public function autorizacion(){
        return $this->belongsTo('App\Models\Autorizacion');
    }
     public function user()
    {
        return $this->belongsTo('App\User');
    }
}
