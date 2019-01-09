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
            
          
             $table->string('tipo_comprobante');
            $table->string('serie_comprobante')->nullable();
            $table->string('num_comprobante');
            $table->datetime('fecha_hora');
            $table->decimal('impuesto');
            $table->decimal('total_devolucion');
            
            $table->string('estado');
          
        
           
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
