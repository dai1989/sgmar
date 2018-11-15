<?php

namespace App\Repositories;

use App\Models\Autorizacion;



class AutorizacionesRepository 
{
    private $model;
    
    public function __construct(){
        $this->model = new Autorizacion();
    }

    public function findByCodigo($q) {
        return $this->model->where('codigo', 'like', "%$q%")
                           ->get();
    }
}
