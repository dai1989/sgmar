<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEstadisticaVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadistica_venta', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('idproducto')->unsigned();
            $table->foreign('idproducto')->references('idproducto')->on('productos');

            
            $table->string('cantidad')->comment('cantidad de productos');
            $table->string('precio_venta')->comment('precio venta de cada producto');
           
           
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
        Schema::dropIfExists('estadistica_venta');
    }
}
