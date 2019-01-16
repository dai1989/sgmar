<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePresupuesto extends Model
{
    protected $table='presupuesto_detalles';

    protected $primaryKey='iddetalle_presupuesto';

    protected $fillable=[
      'venta.id',
      'id_producto',
      'cantidad',
      'precio_venta',
      'descuento'
    ];
}
