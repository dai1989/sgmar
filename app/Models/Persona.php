<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Persona
 * @package App\Models
 * @version November 29, 2018, 10:42 am -03
 *
 * @property \Illuminate\Database\Eloquent\Collection Autorizacion
 * @property \Illuminate\Database\Eloquent\Collection Cliente
 * @property \Illuminate\Database\Eloquent\Collection compraDetalles
 * @property \Illuminate\Database\Eloquent\Collection contactoProveedores
 * @property \Illuminate\Database\Eloquent\Collection Contacto
 * @property \Illuminate\Database\Eloquent\Collection creditoDetalles
 * @property \Illuminate\Database\Eloquent\Collection creditos
 * @property \Illuminate\Database\Eloquent\Collection detallesVentas
 * @property \Illuminate\Database\Eloquent\Collection ingresos
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property \Illuminate\Database\Eloquent\Collection Venta
 * @property string nombre
 * @property string apellido
 * @property integer documento
 * @property date fecha_nacimiento
 * @property string genero
 * @property string tipo_persona
 * @property string tipo_documento
 */
class Persona extends Model
{
    use SoftDeletes;

    public $table = 'personas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'apellido',
        'documento',
        'fecha_nacimiento',
        'genero',
        'tipo_persona',
        'tipo_documento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_persona' => 'integer',
        'nombre' => 'string',
        'apellido' => 'string',
        'documento' => 'integer',
        'fecha_nacimiento' => 'date',
        'genero' => 'string',
        'tipo_persona' => 'string',
        'tipo_documento' => 'string'
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
    public function autorizacions()
    {
        return $this->hasMany(\App\Models\Autorizacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function clientes()
    {
        return $this->hasMany(\App\Models\Cliente::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function contactos()
    {
        return $this->hasMany(\App\Models\Contacto::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function ventas()
    {
        return $this->hasMany(\App\Models\Venta::class);
    }
}
