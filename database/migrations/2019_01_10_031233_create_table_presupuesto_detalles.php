<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePresupuestoDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto_detalles', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('presupuesto_id')->unsigned();
            $table->foreign('presupuesto_id')->references('id')->on('presupuestos');
            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->decimal('cantidad', 11,2)->comment('cantidad de productos');
            $table->decimal('precio_venta', 11,2)->comment('precio venta del producto');
            $table->decimal('descuento', 11,2)->nullable()->comment('descuento del producto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presupuesto_detalles');
    }
}
