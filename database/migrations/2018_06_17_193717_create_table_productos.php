<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) { 
            $table->increments('id');
           
            $table->string ('descripcion', 100);
            $table->string ('precio_venta', 100);
            $table->string('barcode')->unique();
            $table->integer('stock');
            $table->string('imagen')->nullable();
            $table->string('estado');
            $table->integer ('marca_id')->unsigned();
            $table->foreign ('marca_id')->references('id')->on('marcas');
             $table->integer ('categoria_id')->unsigned();
            $table->foreign ('categoria_id')->references('id')->on('categorias')
            ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('productos');
    }
}
