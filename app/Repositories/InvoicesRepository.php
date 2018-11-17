<?php

namespace App\Repositories;

use App\Invoice;



class InvoicesRepository 
{
    private $model;
    
    public function __construct(){
        $this->model = new Invoice();
    }

    public function findByNumero($q) {
        return $this->model->where('numero', 'like', "%$q%")
                           ->get();
    }
}
