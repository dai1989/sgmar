<?php

namespace App\Repositories;

use App\Models\Ingreso;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class IngresoRepository
 * @package App\Repositories
 * @version November 15, 2018, 4:01 pm -03
 *
 * @method Ingreso findWithoutFail($id, $columns = ['*'])
 * @method Ingreso find($id, $columns = ['*'])
 * @method Ingreso first($columns = ['*'])
*/
class IngresoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'autorizacion_id',
        'user_id',
        'concepto',
        'entrega'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Ingreso::class;
    }
}
