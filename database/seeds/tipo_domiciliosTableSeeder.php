<?php

use Illuminate\Database\Seeder;
use App\Models\TipoDomicilio;

class tipo_domiciliosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Tipo de domicilio
        TipoDomicilio::create([
           
            'tipo_descripcion'   => 'Casa Particular',
        ]);

        TipoDomicilio::create([
           
            'tipo_descripcion'   => 'Departamento',            
        ]);
        
        
    }
}
