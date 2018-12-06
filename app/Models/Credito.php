<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Credito extends Model
{
     //
    protected $table = 'creditos';
    
    protected $primaryKey= 'id';

    public $timestamps = false;

    protected $fillable = [
        'id_autorizacion',
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
