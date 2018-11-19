<?php

namespace App\Repositories;

use App\Models\TipoPago   ;

class TipoPagoRepository {
    private $model;
    
    public function __construct(){
        $this->model = new TipoPago();
    }

    public function findByDescripcionPago($q) {
        return $this->model->where('descripcionpago', 'like', "%$q%")
                           ->get();
    }
}
