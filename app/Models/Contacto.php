<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Contacto
 * @package App\Models
 * @version October 7, 2018, 4:39 pm -03
 *
 * @property \App\Models\Persona persona
 * @property \App\Models\TipoContacto tipoContacto
 * @property \Illuminate\Database\Eloquent\Collection contactoProveedores
 * @property \Illuminate\Database\Eloquent\Collection facturaDetalles
 * @property \Illuminate\Database\Eloquent\Collection invoiceItems
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection rolUser
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property integer persona_id
 * @property integer tipocontacto_id
 * @property string contacto_descripcion
 */
class Contacto extends Model
{
    use SoftDeletes;

    public $table = 'contactos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'persona_id',
        'tipocontacto_id',
        'contacto_descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'persona_id' => 'integer',
        'tipocontacto_id' => 'integer',
        'contacto_descripcion' => 'string'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipoContacto()
    {
        return $this->belongsTo(\App\Models\TipoContacto::class);
    }
}
