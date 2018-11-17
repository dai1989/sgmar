<?php

namespace App\Repositories;

use App\Models\Domicilio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DomicilioRepository
 * @package App\Repositories
 * @version November 16, 2018, 9:17 pm -03
 *
 * @method Domicilio findWithoutFail($id, $columns = ['*'])
 * @method Domicilio find($id, $columns = ['*'])
 * @method Domicilio first($columns = ['*'])
*/
class DomicilioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'calle',
        'calle_numero',
        'descripcion',
        'tipodomicilio_id',
        'persona_id',
        'localidad_id',
        'provincia_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Domicilio::class;
    }
}
