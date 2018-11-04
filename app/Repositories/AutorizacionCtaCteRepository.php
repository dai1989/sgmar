<?php

namespace App\Repositories;

use App\Models\AutorizacionCtaCte;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AutorizacionCtaCteRepository
 * @package App\Repositories
 * @version November 4, 2018, 3:15 pm -03
 *
 * @method AutorizacionCtaCte findWithoutFail($id, $columns = ['*'])
 * @method AutorizacionCtaCte find($id, $columns = ['*'])
 * @method AutorizacionCtaCte first($columns = ['*'])
*/
class AutorizacionCtaCteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'persona_id',
        'fecha_alta',
        'monto_actual',
        'condicion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AutorizacionCtaCte::class;
    }
}
