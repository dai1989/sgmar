<?php

namespace App\Repositories;

use App\Models\Proveedor    ;

class ProveedorRepository {
    private $model;
    
    public function __construct(){
        $this->model = new Proveedor();
    }

    public function findByRazonSocial($q) {
        return $this->model->where('razon_social', 'like', "%$q%")
                           ->get();
    }
}
