<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Producto
 * @package App\Models
 * @version December 19, 2018, 4:07 pm -03
 *
 * @property \App\Models\Categoria categoria
 * @property \App\Models\Marca marca
 * @property \Illuminate\Database\Eloquent\Collection contactoProveedores
 * @property \Illuminate\Database\Eloquent\Collection contactos
 * @property \Illuminate\Database\Eloquent\Collection DetallesCredito
 * @property \Illuminate\Database\Eloquent\Collection DetallesIngreso
 * @property \Illuminate\Database\Eloquent\Collection DetallesVenta
 * @property \Illuminate\Database\Eloquent\Collection DevolucionDetalle
 * @property \Illuminate\Database\Eloquent\Collection devoluciones
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection presupuesto
 * @property \Illuminate\Database\Eloquent\Collection PresupuestoDetalle
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property string descripcion
 * @property string precio_venta
 * @property string barcode
 * @property integer stock
 * @property string imagen
 * @property string estado
 * @property integer id_marca
 * @property integer id_categoria
 */
class Producto extends Model
{
    use SoftDeletes;

    public $table = 'productos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'descripcion',
        'precio_venta',
        'barcode',
        'stock',
        'imagen',
        'estado',
        'marca_id',
        'categoria_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'descripcion' => 'string',
        'precio_venta' => 'string',
        'barcode' => 'string',
        'stock' => 'integer',
        'imagen' => 'string',
        'estado' => 'string',
        'marca_id' => 'integer',
        'categoria_id' => 'integer'
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
    public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function marca()
    {
        return $this->belongsTo(\App\Models\Marca::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function detallesCreditos()
    {
        return $this->hasMany(\App\Models\DetallesCredito::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function detallesIngresos()
    {
        return $this->hasMany(\App\Models\DetallesIngreso::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function detallesVentas()
    {
        return $this->hasMany(\App\Models\DetallesVenta::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function devolucionDetalles()
    {
        return $this->hasMany(\App\Models\DevolucionDetalle::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function presupuestoDetalles()
    {
        return $this->hasMany(\App\Models\PresupuestoDetalle::class);
    }
}
