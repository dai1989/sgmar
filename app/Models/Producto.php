<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = ['codigo','descripcion','precio_venta','barcode','estado','imagen','stock'];
    
     public function proveedor ()
    {
        return $this->belongsTo("App\Models\Proveedor");
    }
     
     public function categoria ()
    {
        return $this->belongsTo("App\Models\Categoria");
    }
     
     public function marca ()
    {
        return $this->belongsTo("App\Models\Marca");
    }
 
   
    public function scopeDescripcion($query, $descripcion)
    {
        if ($descripcion)
            return $query->where('descripcion', 'LIKE', "%$descripcion%");
    }
}
