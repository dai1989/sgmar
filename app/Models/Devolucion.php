<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
     //
    protected $table = 'devoluciones'; 
    
    protected $primaryKey= 'id';

    public $timestamps = false;

    protected $fillable = [
        'id_detalleventas',
        'persona_id',
        'tipo_comprobante',
        
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'total_devolucion',
        'estado'
    ];

    protected $guarded = [

        
    ];

     
    
   
    public function venta(){
        return $this->belongsTo('App\Models\Venta');
    }
    public function tipopago(){
        return $this->belongsTo('App\Models\TipoPago');
    }
     public function tipofactura(){
        return $this->belongsTo('App\Models\TipoFactura');
    }
     public function user()
    {
        return $this->belongsTo('App\User');
    }
}
