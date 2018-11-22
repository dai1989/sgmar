<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ContactoProveedor
 * @package App\Models
 * @version November 22, 2018, 2:34 pm -03
 *
 * @property \App\Models\Proveedore proveedore
 * @property \App\Models\TipoContacto tipoContacto
 * @property \Illuminate\Database\Eloquent\Collection compraDetalles
 * @property \Illuminate\Database\Eloquent\Collection contactos
 * @property \Illuminate\Database\Eloquent\Collection creditoDetalles
 * @property \Illuminate\Database\Eloquent\Collection creditos
 * @property \Illuminate\Database\Eloquent\Collection devolucionDetalles
 * @property \Illuminate\Database\Eloquent\Collection devoluciones
 * @property \Illuminate\Database\Eloquent\Collection facturaDetalles
 * @property \Illuminate\Database\Eloquent\Collection ingresos
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection presupuesto
 * @property \Illuminate\Database\Eloquent\Collection presupuestoDetalles
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property string contac_descripcion
 * @property integer proveedor_id
 * @property integer tipocontacto_id
 */
class ContactoProveedor extends Model
{
    use SoftDeletes;

    public $table = 'contacto_proveedores';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'contac_descripcion',
        'proveedor_id',
        'tipocontacto_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'contac_descripcion' => 'string',
        'proveedor_id' => 'integer',
        'tipocontacto_id' => 'integer'
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
    public function tipocontacto()
    {
        return $this->belongsTo(\App\Models\TipoContacto::class);
    }
}
