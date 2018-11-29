<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyCompraDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compra_detalles', function (Blueprint $table) {
             $table->integer ('compra_id')->unsigned();
            $table->foreign ('compra_id')->references('id')->on('compras');
            $table->integer ('producto_id')->unsigned();
            $table->foreign ('producto_id')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compra_detalles', function (Blueprint $table) {
            //
        });
    }
}
