<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresoTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
     {
          DB::unprepared('
            CREATE TRIGGER tr_updStockIngreso AFTER INSERT ON detalles_ingresos
            FOR EACH ROW BEGIN
                    UPDATE productos SET stock = stock + NEW.cantidad
                    WHERE productos.id = NEW.id_producto;
                END');
    }
   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         DB::unprepared('DROP TRIGGER tr_updStockIngreso');
    }
}
