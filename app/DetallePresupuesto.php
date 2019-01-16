<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePresupuesto extends Model
{
    protected $table='detalle_presupuesto';

    protected $primaryKey='iddetalle_presupuesto';

    protected $fillable=[
      'idventa',
      'idproducto',
      'cantidad',
      'precio_venta',
      'descuento'
    ];
}
