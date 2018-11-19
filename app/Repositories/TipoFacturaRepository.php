<?php

namespace App\Repositories;

use App\Models\TipoFactura   ;

class TipoFacturaRepository {
    private $model;
    
    public function __construct(){
        $this->model = new TipoFactura();
    }

    public function findByDescripcion($q) {
        return $this->model->where('descripcion', 'like', "%$q%")
                           ->get();
    }
}
