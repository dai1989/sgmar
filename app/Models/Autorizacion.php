<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Autorizacion
 * @package App\Models
 * @version November 15, 2018, 1:24 pm -03
 *
 * @property \App\Models\Persona persona
 * @property \Illuminate\Database\Eloquent\Collection contactoProveedores
 * @property \Illuminate\Database\Eloquent\Collection contactos
 * @property \Illuminate\Database\Eloquent\Collection cuentacteDetalles
 * @property \Illuminate\Database\Eloquent\Collection Cuentacte
 * @property \Illuminate\Database\Eloquent\Collection facturacompraDetalles
 * @property \Illuminate\Database\Eloquent\Collection invoiceItems
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection presupuesto
 * @property \Illuminate\Database\Eloquent\Collection presupuestoDetalles
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property integer persona_id
 * @property string codigo
 * @property date fecha_alta
 * @property string monto_actual
 * @property boolean condicion
 */
class Autorizacion extends Model
{
    use SoftDeletes;

    public $table = 'autorizacion';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'persona_id',
        'codigo',
        'fecha_alta',
        'monto_actual',
        'condicion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'persona_id' => 'integer',
        'codigo' => 'string',
        'fecha_alta' => 'date',
        'monto_actual' => 'string',
        'condicion' => 'boolean'
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
    public function persona()
    {
        return $this->belongsTo(\App\Models\Persona::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function cuentactes()
    {
        return $this->hasMany(\App\Models\Cuentacte::class);
    }
}
