<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetalleVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_venta', function (Blueprint $table) {
           
            $table->increments('iddetalle_venta')->comment('id del detalle de la venta');

            $table->integer('idventa')->unsigned()->comment('relación del detalle de la venta con la venta');
            
            $table->integer('idproducto')->unsigned()->comment('relación del detalle del ingreso con el artículo');
            $table->decimal('cantidad', 11,2)->comment('cantidad de productos');
            $table->decimal('precio_venta', 11,2)->comment('precio venta del producto');
            $table->decimal('descuento', 11,2)->nullable()->comment('descuento del producto');
           
            $table->foreign('idventa')
                  ->references('idventa')->on('venta');
            $table->foreign('idproducto')
                  ->references('idproducto')->on('productos');
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
        Schema::dropIfExists('detalle_venta');
    }
}
