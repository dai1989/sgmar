<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDevolucionDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devolucion_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_devolucion')->unsigned();
            $table->integer('id_producto')->unsigned();

            $table->foreign('id_devolucion')->references('id')->on('devoluciones');
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->decimal('cantidad', 10,2);
            $table->decimal('precio_venta', 10,2);
            $table->decimal('total', 10,2);
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
        Schema::dropIfExists('devolucion_detalles');
    }
}
