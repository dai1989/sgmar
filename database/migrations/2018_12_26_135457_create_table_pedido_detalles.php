<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePedidoDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_detalles', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('id_pedido')->unsigned();
            $table->foreign('id_pedido')->references('id')->on('pedidos');
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
        Schema::dropIfExists('pedido_detalles');
    }
}
