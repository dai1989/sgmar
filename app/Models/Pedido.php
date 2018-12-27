<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
     protected $table = 'pedidos';

    protected $primaryKey = 'id';

    public $timestamps=false;

    protected $fillable =[
	'id_proveedor',
	'id_user',
	'fecha_hora',
	'total_venta',
	
	'condiciones',
    ];

    protected $guarded = [
    ]; 
}
