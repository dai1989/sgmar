<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Producto
 * @package App\Models
 * @version January 15, 2019, 8:24 pm -03
 *
 * @property \App\Models\Categoria categoria
 * @property \App\Models\Marca marca
 * @property \Illuminate\Database\Eloquent\Collection contactoProveedores
 * @property \Illuminate\Database\Eloquent\Collection contactos
 * @property \Illuminate\Database\Eloquent\Collection detalleEstimacion
 * @property \Illuminate\Database\Eloquent\Collection detalleIngreso
 * @property \Illuminate\Database\Eloquent\Collection detallePresupuesto
 * @property \Illuminate\Database\Eloquent\Collection detalleVenta
 * @property \Illuminate\Database\Eloquent\Collection DetallesCredito
 * @property \Illuminate\Database\Eloquent\Collection EstadisticaVentum
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection presupuesto
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property \Illuminate\Database\Eloquent\Collection venta
 * @property string descripcion
 * @property string precio_venta
 * @property string barcode
 * @property integer stock
 * @property string imagen
 * @property string estado
 * @property integer marca_id
 * @property integer categoria_id
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
        'idproducto' => 'integer',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function estimacions()
    {
        return $this->belongsToMany(\App\Models\Estimacion::class, 'detalle_estimacion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function ingresos()
    {
        return $this->belongsToMany(\App\Models\Ingreso::class, 'detalle_ingreso');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function presupuestos()
    {
        return $this->belongsToMany(\App\Models\Presupuesto::class, 'detalle_presupuesto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function venta()
    {
        return $this->belongsToMany(\App\Models\Ventum::class, 'detalle_venta');
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
    public function estadisticaVenta()
    {
        return $this->hasMany(\App\Models\EstadisticaVentum::class);
    }
}
