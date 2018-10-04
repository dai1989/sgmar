<?php

namespace App\Repositories;

use App\Models\Marca;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MarcaRepository
 * @package App\Repositories
 * @version October 3, 2018, 7:48 pm -03
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
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Marca::class;
    }
}
