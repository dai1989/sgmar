<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePresupuestoDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer ('presupuesto_id')->unsigned();
            $table->foreign ('presupuesto_id')->references('id')->on('presupuesto');
            $table->integer ('producto_id')->unsigned();
            $table->foreign ('producto_id')->references('id')->on('productos');
            $table->string('cantidad');
            $table->float('precio_venta',8,2);
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
        Schema::dropIfExists('presupuesto_detalles');
    }
}
