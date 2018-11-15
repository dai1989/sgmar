<?php

namespace App\Repositories;

use App\Models\Autorizacion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AutorizacionRepository
 * @package App\Repositories
 * @version November 15, 2018, 1:24 pm -03
 *
 * @method Autorizacion findWithoutFail($id, $columns = ['*'])
 * @method Autorizacion find($id, $columns = ['*'])
 * @method Autorizacion first($columns = ['*'])
*/
class AutorizacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'persona_id',
        'codigo',
        'fecha_alta',
        'monto_actual',
        'condicion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Autorizacion::class;
    }
}
