<?php

namespace App\Repositories;

use App\Models\ContactoProveedor;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactoProveedorRepository
 * @package App\Repositories
 * @version November 22, 2018, 2:34 pm -03
 *
 * @method ContactoProveedor findWithoutFail($id, $columns = ['*'])
 * @method ContactoProveedor find($id, $columns = ['*'])
 * @method ContactoProveedor first($columns = ['*'])
*/
class ContactoProveedorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'contac_descripcion',
        'proveedor_id',
        'tipocontacto_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactoProveedor::class;
    }
}
