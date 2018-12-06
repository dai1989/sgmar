<?php

namespace App\Repositories;

use App\Models\Articulo    ;

class ArticuloRepository {
    private $model;
    
    public function __construct(){
        $this->model = new Articulo();
    }

    public function findByDescripcion($q) {
        return $this->model->where('descripcion', 'like', "%$q%")
                           ->get();
    }
}
