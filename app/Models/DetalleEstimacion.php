<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleEstimacion extends Model
{
    protected $table='detalle_estimacion';

    protected $primaryKey='id';

    protected $fillable=[
      'idestimacion',
      'idproducto',
      'cantidad',
      'precio_venta',
      'descuento'
    ];
}
