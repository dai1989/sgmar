<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetallesDevoluciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_devoluciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_devolucion')->unsigned();
            $table->foreign('id_devolucion')->references('id')->on('devoluciones');
            $table->integer('id_producto')->unsigned();
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->integer('cantidad');
            $table->decimal('precio_venta', 10,2);
            $table->decimal('descuento', 10,2);
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
        Schema::dropIfExists('detalles_devoluciones');
    }
}
