<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDomicilios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domicilios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('calle', 100);
            $table->string('calle_numero', 100);
            $table->string('descripcion', 100)->nullable();
            $table->integer('tipodomicilio_id')->unsigned();
            $table->foreign('tipodomicilio_id')->references('id')
            ->on('tipo_domicilios')->onUpdate('cascade')->onDelete('cascade');
            $table->integer ('persona_id')->unsigned();
            $table->foreign ('persona_id')->references('id')->on('personas');
            $table->integer('localidad_id')->unsigned();
            $table->foreign('localidad_id')->references('id')->on('localidad');
            $table->integer('provincia_id')->unsigned();
            $table->foreign('provincia_id')->references('id')->on('provincias');
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
        Schema::dropIfExists('domicilios');
    }
}
