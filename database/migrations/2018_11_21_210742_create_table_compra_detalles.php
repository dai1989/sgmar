<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCompraDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer ('compra_id')->unsigned();
            $table->foreign ('compra_id')->references('id')->on('compras');
            $table->integer ('producto_id')->unsigned();
            $table->foreign ('producto_id')->references('id')->on('productos');
            $table->string('cantidad');
            $table->decimal('precio');
            $table->decimal('total');
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
        Schema::dropIfExists('compra_detalles');
    }
}
