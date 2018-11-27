<?php

use Illuminate\Database\Seeder;
use App\Models\Provincia;

class provinciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provincia::create([
           
            'descripcion'   => 'Buenos Aires',
        ]);

        Provincia::create([
           
            'descripcion'   => 'Catamarca',            
        ]);
        
        Provincia::create([
          
            'descripcion'   => 'Chaco',
        ]);
        
        Provincia::create([
           
            'descripcion'   => ' Chubut',
        ]);
        
        Provincia::create([
           
            'descripcion'   => 'Córdoba',      
        ]);

         Provincia::create([
           
            'descripcion'   => 'Corrientes',      
        ]);

          Provincia::create([
           
            'descripcion'   => 'Entre Ríos',      
        ]);

           Provincia::create([
           
            'descripcion'   => 'Formosa',      
        ]);

         Provincia::create([
           
            'descripcion'   => 'Jujuy',      
        ]);

          Provincia::create([
           
            'descripcion'   => 'La Pampa',      
        ]);

           Provincia::create([
           
            'descripcion'   => 'La Rioja',      
        ]);

         Provincia::create([
           
            'descripcion'   => 'Mendoza',      
        ]);

          Provincia::create([
           
            'descripcion'   => 'Misiones',      
        ]);

           Provincia::create([
           
            'descripcion'   => 'Neuquén',      
        ]);

         Provincia::create([
           
            'descripcion'   => 'Río Negro',      
        ]);

          Provincia::create([
           
            'descripcion'   => 'Salta',      
        ]);

           Provincia::create([
           
            'descripcion'   => 'San Juan',      
        ]);

           Provincia::create([
           
            'descripcion'   => 'San Luis',      
        ]);

         Provincia::create([
           
            'descripcion'   => 'Santa Cruz',      
        ]);

          Provincia::create([
           
            'descripcion'   => 'Santa Fe',      
        ]);

           Provincia::create([
           
            'descripcion'   => 'Santiago del Estero',      
        ]);

         Provincia::create([
           
            'descripcion'   => 'Tierra del Fuego, Antártida e Isla del Atlántico Sur',      
        ]);

          Provincia::create([
           
            'descripcion'   => 'Tucumán',      
        ]);


    }
}
