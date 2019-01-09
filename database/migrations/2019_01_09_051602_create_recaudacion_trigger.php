<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecaudacionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_updStockRecaudacion AFTER INSERT ON detalle_recaudacion
        FOR EACH ROW BEGIN
                UPDATE productos SET stock = stock - NEW.cantidad
                WHERE productos.id = NEW.id;

                IF EXISTS(SELECT * FROM estadistica_venta WHERE estadistica_venta.producto_id = NEW.id)THEN
                  UPDATE estadistica_venta SET cantidad = cantidad + NEW.cantidad
                  WHERE estadistica_venta.producto_id = NEW.id;
                  UPDATE estadistica_venta SET precio_venta = precio_venta + NEW.precio_venta
                  WHERE estadistica_venta.producto_id = NEW.id;
                ELSE
                  INSERT INTO estadistica_venta (producto_id,cantidad,precio_venta,created_at)
                  VALUES(NEW.id,NEW.cantidad,NEW.precio_venta,NOW());
                END IF;
            END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
