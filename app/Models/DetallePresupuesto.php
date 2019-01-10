<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePresupuesto extends Model
{
    protected $table='presupuesto_detalles';

    protected $primaryKey='id';

    protected $fillable=[
      'venta.id',
      'producto_id',
      'cantidad',
      'precio_venta',
      'descuento'
    ];
}
