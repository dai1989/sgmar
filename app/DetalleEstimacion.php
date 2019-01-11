<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleEstimacion extends Model
{
    protected $table='detalle_estimacion';

    protected $primaryKey='id';

    protected $fillable=[
      'estimacion_id',
      'id_producto',
      'cantidad',
      'precio_venta',
      'descuento'
    ];
}
