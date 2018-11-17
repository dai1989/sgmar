<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TipoDomicilio
 * @package App\Models
 * @version November 16, 2018, 9:14 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection contactoProveedores
 * @property \Illuminate\Database\Eloquent\Collection contactos
 * @property \Illuminate\Database\Eloquent\Collection creditoDetalles
 * @property \Illuminate\Database\Eloquent\Collection creditos
 * @property \Illuminate\Database\Eloquent\Collection Domicilio
 * @property \Illuminate\Database\Eloquent\Collection facturacompraDetalles
 * @property \Illuminate\Database\Eloquent\Collection ingresos
 * @property \Illuminate\Database\Eloquent\Collection invoiceItems
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection presupuesto
 * @property \Illuminate\Database\Eloquent\Collection presupuestoDetalles
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property string tipo_descripcion
 */
class TipoDomicilio extends Model
{
    use SoftDeletes;

    public $table = 'tipo_domicilios';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo_descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipo_descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function domicilios()
    {
        return $this->hasMany(\App\Models\Domicilio::class);
    }
}
