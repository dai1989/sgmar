<?php

use Illuminate\Database\Seeder;
use App\Models\TipoPago;

class tipo_pagosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Tipo de pago
        TipoPago::create([
           
            'descripcionpago'   => 'Efectivo',
        ]);

        TipoPago::create([
           
            'descripcionpago'   => 'Tarjeta de Credito',            
        ]);
        
        TipoPago::create([
          
            'descripcionpago'   => 'Tarjeta de debito',
        ]);
        
        TipoPago::create([
           
            'descripcionpago'   => 'Nota de credito',
        ]);
    }
}
