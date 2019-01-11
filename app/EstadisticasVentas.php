<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadisticasVentas extends Model
{
  protected $table='estadistica_venta';

  protected $primaryKey='id';

  protected $fillable=[
    'id_producto',
    'cantidad',
    'precio_venta',
    'created_at'
  ];
}
