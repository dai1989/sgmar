<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Ingreso extends Model
{
     //
    protected $table = 'ingresos';
    
    protected $primaryKey= 'id';

    public $timestamps = false;

    protected $fillable = [
        'id_proveedor',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'estado'
    ];

    protected $guarded = [

        
    ];
}
