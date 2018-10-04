<?php

use Illuminate\Database\Seeder;
use App\Models\TipoContacto;

class tipo_contactosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Categorias
        TipoContacto::create([
           
            'contacto_descripcion'   => 'Celular',
        ]);

        TipoContacto::create([
           
            'contacto_descripcion'   => 'Celular/Trabajo',            
        ]);
        
        TipoContacto::create([
          
            'contacto_descripcion'   => 'Telefono Fijo/Casa',
        ]);
        
        TipoContacto::create([
           
            'contacto_descripcion'   => 'Telefono Fijo/Trabajo',
        ]);
        
        TipoContacto::create([
           
            'contacto_descripcion'   => 'Email',      
        ]);

         TipoContacto::create([
           
            'contacto_descripcion'   => 'Email/Trabajo',      
        ]);

          TipoContacto::create([
           
            'contacto_descripcion'   => 'Tel/Fax',      
        ]);

        
    }
}
