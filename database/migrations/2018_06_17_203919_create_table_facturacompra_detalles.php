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
            $table->integer ('factura_compra_id')->unsigned();
            $table->foreign ('factura_compra_id')->references('id')->on('factura_compra');
            $table->integer ('producto_id')->unsigned();
            $table->foreign ('producto_id')->references('id')->on('productos');
            $table->string('cantidad');
            $table->float('precio_compra',8,2);
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
