<?php

namespace App\Repositories;

use App\Models\User;
use InfyOm\Generator\Common\BaseRepository;

class UserRepository {
    private $model;
    
    public function __construct(){
        $this->model = new User();
    }

    public function findByName($q) {
        return $this->model->where('name', 'like', "%$q%")
                           ->get();
    }
}
