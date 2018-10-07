<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContactoProveedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto_proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contac_descripcion', 50)->nullable();
            $table->integer('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedores')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('tipocontacto_id')->unsigned();
            $table->foreign('tipocontacto_id')->references('id')->on('tipo_contactos')
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
        Schema::dropIfExists('contacto_proveedores');
    }
}
