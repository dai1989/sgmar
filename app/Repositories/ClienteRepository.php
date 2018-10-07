<?php

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository {
    private $model;
    
    public function __construct(){
        $this->model = new Cliente();
    }

    public function findByNombre($q) {
        return $this->model->where('nombre', 'like', "%$q%")
                           ->get();
    }
}