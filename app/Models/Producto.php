<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Producto
 * @package App\Models
 * @version December 1, 2018, 11:27 pm -03
 *
 * @property \App\Models\Categoria categoria
 * @property \App\Models\Marca marca
 * @property \Illuminate\Database\Eloquent\Collection CompraDetalle
 * @property \Illuminate\Database\Eloquent\Collection contactoProveedores
 * @property \Illuminate\Database\Eloquent\Collection contactos
 * @property \Illuminate\Database\Eloquent\Collection CreditoDetalle
 * @property \Illuminate\Database\Eloquent\Collection creditos
 * @property \Illuminate\Database\Eloquent\Collection detallesVentas
 * @property \Illuminate\Database\Eloquent\Collection ingresos
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection PedidoDetalle
 * @property \Illuminate\Database\Eloquent\Collection pedidos
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
        'id_marca',
        'id_categoria'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_producto' => 'integer',
        'descripcion' => 'string',
        'precio_venta' => 'string',
        'barcode' => 'string',
        'stock' => 'integer',
        'imagen' => 'string',
        'estado' => 'string',
        'id_marca' => 'integer',
        'id_categoria' => 'integer'
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
    public function compraDetalles()
    {
        return $this->hasMany(\App\Models\CompraDetalle::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function creditoDetalles()
    {
        return $this->hasMany(\App\Models\CreditoDetalle::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function ventas()
    {
        return $this->belongsToMany(\App\Models\Venta::class, 'detalles_ventas');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pedidoDetalles()
    {
        return $this->hasMany(\App\Models\PedidoDetalle::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function presupuestoDetalles()
    {
        return $this->hasMany(\App\Models\PresupuestoDetalle::class);
    }
}
