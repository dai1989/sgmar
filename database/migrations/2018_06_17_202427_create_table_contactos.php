<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContactos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('personas')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('tipocontacto_id')->unsigned();
            $table->foreign('tipocontacto_id')->references('id')->on('tipo_contactos')
            ->onUpdate('cascade')->onDelete('cascade');
            
            $table->string('contac_descripcion', 50)->nullable();
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
        Schema::dropIfExists('contactos');
    }
}
