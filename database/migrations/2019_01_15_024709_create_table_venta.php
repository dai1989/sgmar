<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
           
            $table->increments('idventa')->comment('id de la venta');
             $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('personas');

            $table->integer('idusuario')->unsigned()->comment('relación de la venta con el usuario');

            $table->string('tipo_comprobante',30)->nullable()->comment('tipo de comprobante de la venta');

            $table->string('num_comprobante',30)->nullable()->comment('numero de la venta');
            
            $table->date('fecha_hora')->comment('fecha de la venta');
            $table->decimal('impuesto',4 , 2)->comment('impuesto de la venta');
            $table->decimal('total_venta',11 , 2)->comment('total de la venta');
            $table->decimal('entrega',11 , 2)->comment('cuanto es el total de la venta');
            $table->string('estado',20)->comment('estado de la venta');
            
            
            $table->foreign('idusuario')
                  ->references('id')->on('users');
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
        Schema::dropIfExists('venta');
    }
}
