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
            $table->integer('devolucion_id')->unsigned();
            $table->integer('producto_id')->unsigned();

            $table->foreign('devolucion_id')->references('id')->on('devoluciones');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->string('observacion');
            $table->decimal('cantidad', 10,2);
            $table->decimal('precio_venta', 10,2);
            $table->decimal('total', 10,2);
            $table->timestamps();
            $table->softDeletes();
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
