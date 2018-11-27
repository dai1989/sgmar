<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyContactoProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacto_proveedores', function (Blueprint $table) {
             $table->integer('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedores')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('tipocontacto_id')->unsigned();
            $table->foreign('tipocontacto_id')->references('id')->on('tipo_contactos')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacto_proveedores', function (Blueprint $table) {
           
        });
    }
}
