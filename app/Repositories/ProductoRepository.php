<?php

namespace App\Repositories;

use App\Models\Producto    ;

class ProductoRepository {
    private $model;
    
    public function __construct(){
        $this->model = new Producto();
    }

    public function findByDescripcion($q) {
        return $this->model->where('descripcion', 'like', "%$q%")
                           ->get();
    }
}
