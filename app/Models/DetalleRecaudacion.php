 <?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleRecaudacion extends Model
{
    protected $table='detalle_recaudacion';

    protected $primaryKey='id';

    protected $fillable=[
      'recaudacion_id',
      'id_producto',
      'cantidad',
      'precio_venta',
      'descuento'
    ];
}
