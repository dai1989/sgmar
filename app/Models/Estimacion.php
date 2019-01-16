<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimacion extends Model
{
  protected $table='estimacion';

  protected $primaryKey='idestimacion';

  protected $fillable=[
    'user_id',
    'fecha_hora',
    'impuesto',
    'total_venta',
    'estado'
  ];
}