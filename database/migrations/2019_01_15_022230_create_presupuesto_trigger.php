<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestoTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::unprepared('
        CREATE TRIGGER tr_updStockPresupuesto AFTER INSERT ON detalle_presupuesto
        FOR EACH ROW BEGIN
                UPDATE productos SET stock = stock - NEW.cantidad
                WHERE productos.idproducto = NEW.idproducto;

                IF EXISTS(SELECT * FROM estadistica_venta WHERE estadistica_venta.idproducto = NEW.idproducto)THEN
                  UPDATE estadistica_venta SET cantidad = cantidad + NEW.cantidad
                  WHERE estadistica_venta.idproducto = NEW.idproducto;
                  UPDATE estadistica_venta SET precio_venta = precio_venta + NEW.precio_venta
                  WHERE estadistica_venta.idproducto = NEW.idproducto;
                ELSE
                  INSERT INTO estadistica_venta (idproducto,cantidad,precio_venta,created_at)
                  VALUES(NEW.idproducto,NEW.cantidad,NEW.precio_venta,NOW());
                END IF;
            END');
    }

    public function down()
    {
        //
    }
}
