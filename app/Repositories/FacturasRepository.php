<?php

namespace App\Repositories;

use App\Models\Factura ;



class FacturasRepository 
{
    private $model;
    
    public function __construct(){
        $this->model = new Factura();
    }

    public function findByNumero($q) {
        return $this->model->where('numero', 'like', "%$q%")
                           ->get();
    }
}
