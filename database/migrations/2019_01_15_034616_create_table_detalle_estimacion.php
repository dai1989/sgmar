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
            
             $table->increments('iddetalle_estimacion')->comment('id del detalle de la estimacion');
            $table->integer('idestimacion')->unsigned()->comment('relación de la detalle de la estimacion con la estimacion');
            $table->integer('idproducto')->unsigned()->comment('relación del detalle de la estimacion con el artículo');
            $table->decimal('cantidad', 11,2)->comment('cantidad de productos');
            $table->decimal('precio_venta', 11,2)->comment('precio venta del producto');
            $table->decimal('descuento', 11,2)->nullable()->comment('descuento del producto');
            
            $table->foreign('idestimacion')
                  ->references('idestimacion')->on('estimacion');
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
        Schema::dropIfExists('detalle_estimacion');
    }
}
