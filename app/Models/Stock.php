<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Stock
 * @package App\Models
 * @version October 3, 2018, 9:44 pm -03
 *
 * @property \App\Models\Producto producto
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection rolUser
 * @property integer producto_id
 * @property integer cantidad_actual
 * @property integer cantidad_minima
 */
class Stock extends Model
{
    use SoftDeletes;

    public $table = 'stock';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'producto_id',
        'cantidad_actual',
        'cantidad_minima'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'producto_id' => 'integer',
        'cantidad_actual' => 'integer',
        'cantidad_minima' => 'integer'
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
    public function producto()
    {
        return $this->belongsTo(\App\Models\Producto::class);
    }
}
