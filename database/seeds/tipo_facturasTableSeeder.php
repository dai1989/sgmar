<?php

use Illuminate\Database\Seeder;
use App\Models\TipoFactura;
class tipo_facturasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Tipo de factura
        TipoFactura::create([
           
            'descripcion'   => 'A',
        ]);

        TipoFactura::create([
           
            'descripcion'   => 'B',            
        ]);
        
        TipoFactura::create([
          
            'descripcion'   => 'C',
        ]);
        
        
    }
}
