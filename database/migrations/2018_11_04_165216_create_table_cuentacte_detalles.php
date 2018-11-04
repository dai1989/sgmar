<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCuentacteDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentacte_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cuenta_cte')->unsigned();
            $table->integer('producto_id')->unsigned();

            $table->foreign('cuenta_cte')->references('id')->on('cuenta_ctes');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->decimal('cantidad', 10,2);
            $table->decimal('entrega', 10,2);
            $table->decimal('precio_venta', 10,2);
            $table->decimal('total', 10,2);
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
        Schema::dropIfExists('cuentacte_detalles');
    }
}
