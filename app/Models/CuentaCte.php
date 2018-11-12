<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuentaCte extends Model
{
	protected $table = 'cuenta_ctes';
    public function obtenerTotal()
    {
    	$detalle_list = CuentaCteDetalle::where('cuentacte_id', $this->id)->get();
    	$total = 0;
        $iva = 0;
    	foreach ($detalle_list as $detalle) {
    		$subtotal = $detalle->precio_venta * $detalle->cantidad;
            $iva = $subtotal * 21 / 100;
            $total = $total + $subtotal + $iva;
    	    
    	}
    	return $total;
    }

    public function persona()
    {
    	return $this->belongsTo('App\Models\Persona'); 
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function tipopago()
    {
        return $this->belongsTo('App\Models\TipoPago');
    }
     public function detail()
    {
        return $this->hasMany('App\Models\CuentaCteDetalle');
    }
}


