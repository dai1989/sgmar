<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FacturaCompra
 * @package App\Models
 * @version October 9, 2018, 9:45 pm -03
 *
 * @property \App\Models\Proveedore proveedore
 * @property \App\Models\TipoPago tipoPago
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection contactoProveedores
 * @property \Illuminate\Database\Eloquent\Collection contactos
 * @property \Illuminate\Database\Eloquent\Collection facturaDetalles
 * @property \Illuminate\Database\Eloquent\Collection FacturacompraDetalle
 * @property \Illuminate\Database\Eloquent\Collection invoiceItems
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection rolUser
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property integer proveedor_id
 * @property integer user_id
 * @property integer tipopago_id
 * @property string fac_numero
 * @property string fac_tipo
 * @property date fac_fecha
 */
class FacturaCompra extends Model
{
    use SoftDeletes;

    public $table = 'factura_compra';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'proveedor_id',
        'user_id',
        'tipopago_id',
        'fac_numero',
        'fac_tipo',
        'fac_fecha'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'proveedor_id' => 'integer',
        'user_id' => 'integer',
        'tipopago_id' => 'integer',
        'fac_numero' => 'string',
        'fac_tipo' => 'string',
        'fac_fecha' => 'date'
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
    public function proveedor()
    {
        return $this->belongsTo(\App\Models\Proveedor::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipoPago()
    {
        return $this->belongsTo(\App\Models\TipoPago::class);
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
    public function facturacompraDetalles()
    {
        return $this->hasMany(\App\Models\FacturacompraDetalle::class);
    }
}
