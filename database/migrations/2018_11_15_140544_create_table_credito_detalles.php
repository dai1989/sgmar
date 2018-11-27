<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCreditoDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credito_detalles', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('credito_id')->unsigned();
            $table->integer('producto_id')->unsigned();

            $table->foreign('credito_id')->references('id')->on('creditos');
            $table->foreign('producto_id')->references('id')->on('productos');
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
        Schema::dropIfExists('credito_detalles');
    }
}
