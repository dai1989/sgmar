<?php

namespace App\Repositories;

use App\Models\Proveedor    ;

class ProveedoresRepository {
    private $model;
    
    public function __construct(){
        $this->model = new Proveedor();
    }

    public function findByRazonSocial($q) {
        return $this->model->where('razonsocial', 'like', "%$q%")
                           ->get();
    }
}
