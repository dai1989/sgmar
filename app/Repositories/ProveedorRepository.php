<?php

namespace App\Repositories;

use App\Models\Proveedor;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProveedorRepository
 * @package App\Repositories
 * @version November 3, 2018, 7:26 pm -03
 *
 * @method Proveedor findWithoutFail($id, $columns = ['*'])
 * @method Proveedor find($id, $columns = ['*'])
 * @method Proveedor first($columns = ['*'])
*/
class ProveedorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'razonsocial',
        'cuit'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Proveedor::class;
    }
}
