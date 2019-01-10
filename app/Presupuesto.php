<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Presupuesto extends Model
{
  protected $table='presupuestos';

  protected $primaryKey='id';

  protected $fillable=[
    'persona_id',
    'tipo_comprobante',
    'num_comprobante',
    'fecha_hora',
    'impuesto',
    'total_venta',
    'estado'
  ];

}
