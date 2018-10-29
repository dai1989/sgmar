<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ingreso
 * @package App\Models
 * @version October 10, 2018, 2:02 am -03
 *
 * @property \App\Models\Proveedore proveedore
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection contactoProveedores
 * @property \Illuminate\Database\Eloquent\Collection contactos
 * @property \Illuminate\Database\Eloquent\Collection DetalleIngreso
 * @property \Illuminate\Database\Eloquent\Collection facturaDetalles
 * @property \Illuminate\Database\Eloquent\Collection facturacompraDetalles
 * @property \Illuminate\Database\Eloquent\Collection invoiceItems
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection rolUser
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property integer idproveedor
 * @property integer idusuario
 * @property string tipo_comprobante
 * @property string serie_comprobante
 * @property string num_comprobante
 * @property string|\Carbon\Carbon fecha_hora
 * @property decimal impuesto
 * @property decimal total
 * @property string estado
 */
class Ingreso extends Model
{
    use SoftDeletes;

    public $table = 'ingresos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'idproveedor',
        'idusuario',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'total',
        'estado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'idproveedor' => 'integer',
        'idusuario' => 'integer',
        'tipo_comprobante' => 'string',
        'serie_comprobante' => 'string',
        'num_comprobante' => 'string',
        'estado' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function proveedore()
    {
        return $this->belongsTo(\App\Models\Proveedore::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function detalleIngresos()
    {
        return $this->hasMany(\App\Models\DetalleIngreso::class);
    }
}
