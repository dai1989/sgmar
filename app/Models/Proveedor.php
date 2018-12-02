<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Proveedor
 * @package App\Models
 * @version December 1, 2018, 2:58 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection compraDetalles
 * @property \Illuminate\Database\Eloquent\Collection Compra
 * @property \Illuminate\Database\Eloquent\Collection ContactoProveedore
 * @property \Illuminate\Database\Eloquent\Collection contactos
 * @property \Illuminate\Database\Eloquent\Collection creditoDetalles
 * @property \Illuminate\Database\Eloquent\Collection creditos
 * @property \Illuminate\Database\Eloquent\Collection detallesVentas
 * @property \Illuminate\Database\Eloquent\Collection Ingreso
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection pedidoDetalles
 * @property \Illuminate\Database\Eloquent\Collection pedidos
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection presupuesto
 * @property \Illuminate\Database\Eloquent\Collection presupuestoDetalles
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property string razonsocial
 * @property string cuit
 */
class Proveedor extends Model
{
    use SoftDeletes;

    public $table = 'proveedores';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'razonsocial',
        'cuit'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'razonsocial' => 'string',
        'cuit' => 'string'
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
    public function compras()
    {
        return $this->hasMany(\App\Models\Compra::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function contactoProveedores()
    {
        return $this->hasMany(\App\Models\ContactoProveedore::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function ingresos()
    {
        return $this->hasMany(\App\Models\Ingreso::class);
    }
}
