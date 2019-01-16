<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table='venta';

    protected $primaryKey='idventa';

    protected $fillable=[
        'persona_id',
        'tipo_comprobante',
      'num_comprobante',
        'fecha_hora',
        'impuesto',
        'total_venta',
      'entrega',
        'estado'
    ];
}
