<?php

namespace App\Repositories;

use App\Models\User;

class UsersRepository {
    private $model;
    
    public function __construct(){
        $this->model = new User();
    }

    public function findByName($q) {
        return $this->model->where('name', 'like', "%$q%")
                           ->get();
    }
}