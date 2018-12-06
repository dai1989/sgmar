<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
     //
    protected $table = 'facturas';
    
    protected $primaryKey= 'id';

    public $timestamps = false;

    protected $fillable = [
        'idcliente',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'total_venta',
        'estado'
    ];

    protected $guarded = [

        
    ];
}
