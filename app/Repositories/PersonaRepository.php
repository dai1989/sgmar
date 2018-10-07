<?php

namespace App\Repositories;

use App\Models\Persona;

class PersonaRepository {
    private $model;
    
    public function __construct(){
        $this->model = new Persona();
    }

    public function findByNombre($q) {
        return $this->model->where('nombre', 'like', "%$q%")
                           ->get();
    }
}