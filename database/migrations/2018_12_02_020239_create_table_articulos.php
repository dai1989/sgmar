<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('id');
             $table->string ('descripcion', 100);
            $table->string ('precio_venta', 100);
            $table->string('barcode')->unique();
            $table->integer('stock');
            $table->string('imagen')->nullable();
            $table->string('estado');
            $table->integer ('id_marca')->unsigned();
            $table->foreign ('id_marca')->references('id')->on('marcas');
             $table->integer ('id_categoria')->unsigned();
            $table->foreign ('id_categoria')->references('id')->on('categorias')
            ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('articulos');
    }
}
