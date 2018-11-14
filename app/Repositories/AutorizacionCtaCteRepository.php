<?php

namespace App\Repositories;

use App\Models\AutorizacionCtaCte;

class AutorizacionCtaCteRepository {
    private $model;
    
    public function __construct(){
        $this->model = new AutorizacionCtaCte();
    }

    public function findByCodigo($q) {
        return $this->model->where('codigo', 'like', "%$q%")
                           ->get();
    }
}
