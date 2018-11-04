<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {
    public function detail(){
        return $this->hasMany('App\InvoiceItem');
    }
    public function persona(){
        return $this->belongsTo('App\Models\Persona');
    }
     public function user()
    {
        return $this->belongsTo('App\User');
    }
}