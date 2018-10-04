<?php

namespace App\Repositories;

use App\Models\Stock;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StockRepository
 * @package App\Repositories
 * @version October 3, 2018, 9:44 pm -03
 *
 * @method Stock findWithoutFail($id, $columns = ['*'])
 * @method Stock find($id, $columns = ['*'])
 * @method Stock first($columns = ['*'])
*/
class StockRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'producto_id',
        'cantidad_actual',
        'cantidad_minima'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Stock::class;
    }
}
