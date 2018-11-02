<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{

     protected $table = 'presupuestos';

    public function producto()
    {
        return $this->hasMany(PresupuestoDetalle::class);
    }
}
