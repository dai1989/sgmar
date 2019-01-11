<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetalleEstimacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_estimacion', function (Blueprint $table) {
            $table->increments('id');
              $table->integer('estimacion_id')->unsigned();
            $table->foreign('estimacion_id')->references('id')->on('estimacion');
            $table->integer('id_producto')->unsigned();
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->decimal('cantidad', 11,2)->comment('cantidad de productos');
            $table->decimal('precio_venta', 11,2)->comment('precio venta del producto');
            $table->decimal('descuento', 11,2)->nullable()->comment('descuento del producto');
           
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
        Schema::dropIfExists('detalle_estimacion');
    }
}
