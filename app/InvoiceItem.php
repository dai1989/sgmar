<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model {
    protected $table = 'invoice_items';

    public function producto(){
        return $this->belongsTo('App\Models\Producto');
    }
}
