<?php

namespace App\Repositories;

use App\Models\Persona;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonaRepository
 * @package App\Repositories
 * @version November 29, 2018, 10:42 am -03
 *
 * @method Persona findWithoutFail($id, $columns = ['*'])
 * @method Persona find($id, $columns = ['*'])
 * @method Persona first($columns = ['*'])
*/
class PersonaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'apellido',
        'documento',
        'fecha_nacimiento',
        'genero',
        'tipo_persona',
        'tipo_documento'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Persona::class;
    }
}
