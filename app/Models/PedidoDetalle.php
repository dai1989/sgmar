<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
     protected $table = 'pedido_detalles';

    protected $primaryKey = 'id';

    public $timestamps=false;

    protected $fillable =[
	'id_pedido',
	'id_producto',
	'cantidad',
	'precio_venta',
	'descuento'
    ];

    protected $guarded = [
    ];
}
