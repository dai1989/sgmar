<?php

namespace App\Repositories;

use App\Models\Factura ;



class FacturasRepository 
{
    private $model;
    
    public function __construct(){
        $this->model = new Factura();
    }

    public function findById($q) {
        return $this->model->where('id', 'like', "%$q%")
                           ->get();
    }
}
