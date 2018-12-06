<?php

namespace App\Repositories;

use App\Models\Venta;



class VentaRepository 
{
    private $model;
    
    public function __construct(){
        $this->model = new Venta();
    }

    public function findByNum_comprobante($q) {
        return $this->model->where('num_comprobante', 'like', "%$q%")
                           ->get();
    }
}
