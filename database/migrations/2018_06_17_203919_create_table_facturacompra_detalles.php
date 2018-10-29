<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFacturacompraDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturacompra_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer ('facturacompra_id')->unsigned();
            $table->foreign ('facturacompra_id')->references('id')->on('factura_compra');
            $table->integer ('producto_id')->unsigned();
            $table->foreign ('producto_id')->references('id')->on('productos');
            $table->string('cantidad');
            $table->decimal('precio_compra');
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
        Schema::dropIfExists('facturacompra_detalles');
    }
}
