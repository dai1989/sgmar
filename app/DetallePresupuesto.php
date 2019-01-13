<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePresupuesto extends Model
{
    protected $table='presupuesto_detalles';

    protected $primaryKey='id';

    protected $fillable=[
      'id_venta',
      'id_producto',
      'cantidad',
      'precio_venta',
      'descuento'
    ];
}
