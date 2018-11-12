<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAutorizacionCtacte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autorizacion_ctacte', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('personas');
             $table->string('codigo');
            $table->date('fecha_alta');
            $table->string('monto_actual');
            $table->boolean('condicion')->default(1);
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
        Schema::dropIfExists('autorizacion_ctacte');
    }
}
