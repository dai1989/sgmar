<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyCreditoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credito_detalles', function (Blueprint $table) {
               $table->integer('credito_id')->unsigned();
            $table->integer('producto_id')->unsigned();

            $table->foreign('credito_id')->references('id')->on('creditos');
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
        Schema::table('credito_detalles', function (Blueprint $table) {
            //
        });
    }
}
