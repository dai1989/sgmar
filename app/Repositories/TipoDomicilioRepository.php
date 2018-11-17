<?php

namespace App\Repositories;

use App\Models\TipoDomicilio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TipoDomicilioRepository
 * @package App\Repositories
 * @version November 16, 2018, 9:14 pm -03
 *
 * @method TipoDomicilio findWithoutFail($id, $columns = ['*'])
 * @method TipoDomicilio find($id, $columns = ['*'])
 * @method TipoDomicilio first($columns = ['*'])
*/
class TipoDomicilioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo_descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TipoDomicilio::class;
    }
}
