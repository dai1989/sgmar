<?php

namespace App\Repositories;

use App\Models\Contacto;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactoRepository
 * @package App\Repositories
 * @version October 7, 2018, 4:39 pm -03
 *
 * @method Contacto findWithoutFail($id, $columns = ['*'])
 * @method Contacto find($id, $columns = ['*'])
 * @method Contacto first($columns = ['*'])
*/
class ContactoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'persona_id',
        'tipocontacto_id',
        'contacto_descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Contacto::class;
    }
}
