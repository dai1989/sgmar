<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compras', function (Blueprint $table) {
             $table->integer('id_proveedor')->unsigned();
            $table->foreign('id_proveedor')->references('id')->on('proveedores');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->integer('tipofactura_id')->unsigned();
            $table->foreign('tipofactura_id')->references('id')->on('tipo_facturas');
            $table->integer('tipopago_id')->unsigned();
            $table->foreign('tipopago_id')->references('id')->on('tipo_pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compras', function (Blueprint $table) {
            //
        });
    }
}
