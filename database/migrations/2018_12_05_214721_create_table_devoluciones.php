<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDevoluciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devoluciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venta_id')->unsigned();
            $table->foreign('venta_id')->references('id')->on('ventas');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
          
        
            $table->decimal('iva', 10,2);
            $table->decimal('subTotal', 10,2);
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
        Schema::dropIfExists('devoluciones');
    }
}
