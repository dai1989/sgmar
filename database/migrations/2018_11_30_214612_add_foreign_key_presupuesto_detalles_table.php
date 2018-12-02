<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyPresupuestoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presupuesto_detalles', function (Blueprint $table) {
            $table->integer('presupuesto_id')->unsigned();
            $table->integer('producto_id')->unsigned();

            $table->foreign('presupuesto_id')->references('id')->on('presupuesto');
            $table->foreign('producto_id')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presupuesto_detalles', function (Blueprint $table) {
            //
        });
    }
}
