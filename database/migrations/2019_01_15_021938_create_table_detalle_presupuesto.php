<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetallePresupuesto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_presupuesto', function (Blueprint $table) {
           
             $table->increments('iddetalle_presupuesto')->comment('id del detalle del presupuesto');
            $table->integer('idpresupuesto')->unsigned()->comment('relación del detalle del presupuesto con el presupuesto');

            $table->integer('idproducto')->unsigned()->comment('relación del detalle del presupuesto con el artículo');
            $table->decimal('cantidad', 11,2)->comment('cantidad de productos');
            $table->decimal('precio_venta', 11,2)->comment('precio venta del producto');
            $table->decimal('descuento', 11,2)->nullable()->comment('descuento del producto');
           
            
            $table->foreign('idpresupuesto')
                  ->references('idpresupuesto')->on('presupuesto');
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
        Schema::dropIfExists('detalle_presupuesto');
    }
}
