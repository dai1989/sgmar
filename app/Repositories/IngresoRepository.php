<?php

namespace App\Repositories;

use App\Models\Ingreso;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class IngresoRepository
 * @package App\Repositories
 * @version October 10, 2018, 2:02 am -03
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
        'idproveedor',
        'idusuario',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'total',
        'estado'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Ingreso::class;
    }
}
