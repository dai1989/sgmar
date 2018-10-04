<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TipoContacto
 * @package App\Models
 * @version September 27, 2018, 8:41 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection contactoProveedores
 * @property \Illuminate\Database\Eloquent\Collection Contacto
 * @property \Illuminate\Database\Eloquent\Collection devoluciones
 * @property \Illuminate\Database\Eloquent\Collection facturaDetalles
 * @property \Illuminate\Database\Eloquent\Collection facturacompraDetalles
 * @property \Illuminate\Database\Eloquent\Collection notaCreditos
 * @property \Illuminate\Database\Eloquent\Collection notacreditoDetalles
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection presupuestoDetalles
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property string contacto_descripcion
 */
class TipoContacto extends Model
{
    use SoftDeletes;

    public $table = 'tipo_contactos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'contacto_descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function contactos()
    {
        return $this->hasMany(\App\Models\Contacto::class);
    }
}
