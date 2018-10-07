<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Initalization extends Migration
{
    public function up()
    {
       

        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('iva', 10,2);
            $table->decimal('subTotal', 10,2);
            $table->decimal('total', 10,2);
            $table->timestamps();
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->decimal('cantidad', 10,2);
            $table->decimal('precio_venta', 10,2);
            $table->decimal('total', 10,2);
            $table->timestamps();
        });

        // Foreign keys
        Schema::table('invoices', function ($table) {
            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('personas');
        });

        Schema::table('invoice_items', function ($table) {
            $table->integer('invoice_id')->unsigned();
            $table->integer('producto_id')->unsigned();

            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('producto_id')->references('id')->on('productos');
        });

        
    }

    public function down()
    {

    }
}
