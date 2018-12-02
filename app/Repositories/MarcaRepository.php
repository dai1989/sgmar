<?php

namespace App\Repositories;

use App\Models\Marca;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MarcaRepository
 * @package App\Repositories
 * @version December 2, 2018, 2:24 am -03
 *
 * @method Marca findWithoutFail($id, $columns = ['*'])
 * @method Marca find($id, $columns = ['*'])
 * @method Marca first($columns = ['*'])
*/
class MarcaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Marca::class;
    }
}
