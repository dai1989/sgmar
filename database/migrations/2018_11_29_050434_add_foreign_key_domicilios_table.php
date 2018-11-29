<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyDomiciliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('domicilios', function (Blueprint $table) {
             $table->integer('tipodomicilio_id')->unsigned();
            $table->foreign('tipodomicilio_id')->references('id')
            ->on('tipo_domicilios')->onUpdate('cascade')->onDelete('cascade');
          
            $table->integer('localidad_id')->unsigned();
            $table->foreign('localidad_id')->references('id')->on('localidad');
            $table->integer('provincia_id')->unsigned();
            $table->foreign('provincia_id')->references('id')->on('provincias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('domicilios', function (Blueprint $table) {
            //
        });
    }
}
