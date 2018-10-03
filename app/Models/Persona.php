<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Persona
 * @package App\Models
 * @version October 3, 2018, 3:38 am -03
 *
 * @property \Illuminate\Database\Eloquent\Collection Cliente
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection rolUser
 * @property string nombre
 * @property string apellido
 * @property integer documento
 * @property date fecha_nacimiento
 * @property string genero
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
        'genero'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'apellido' => 'string',
        'documento' => 'integer',
        'fecha_nacimiento' => 'date',
        'genero' => 'string'
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
    public function clientes()
    {
        return $this->hasMany(\App\Models\Cliente::class);
    }
}
