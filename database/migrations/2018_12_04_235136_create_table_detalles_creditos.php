<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetallesCreditos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('detalles_creditos', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('id_credito')->unsigned();
            $table->foreign('id_credito')->references('id')->on('creditos');
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
        Schema::dropIfExists('detalles_creditos');
    }
}
