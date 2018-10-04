<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Productos
        Permission::create([
            'name'          => 'Navegar productos',
            'slug'          => 'productos.index',
            'description'   => 'Lista y navega todos los productos del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un producto',
            'slug'          => 'productos.show',
            'description'   => 'Ve en detalle cada producto del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de productos',
            'slug'          => 'productos.create',
            'description'   => 'Podría crear nuevos productos en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de productos',
            'slug'          => 'productos.edit',
            'description'   => 'Podría editar cualquier dato de un producto del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar productos',
            'slug'          => 'productos.destroy',
            'description'   => 'Podría eliminar cualquier producto del sistema',      
        ]);

         //Categorias
        Permission::create([
            'name'          => 'Navegar categorias',
            'slug'          => 'categorias.index',
            'description'   => 'Lista y navega todas las categorias del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una categoria',
            'slug'          => 'categorias.show',
            'description'   => 'Ve en detalle cada categoria del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de categoria',
            'slug'          => 'categorias.create',
            'description'   => 'Podría crear nuevas categorias en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de categorias',
            'slug'          => 'categorias.edit',
            'description'   => 'Podría editar cualquier dato de una categoria del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar categorias',
            'slug'          => 'categorias.destroy',
            'description'   => 'Podría eliminar cualquier categoria del sistema',      
        ]);

         //Marcas
        Permission::create([
            'name'          => 'Navegar marcas',
            'slug'          => 'marcas.index',
            'description'   => 'Lista y navega todos los marcas del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una marca',
            'slug'          => 'marcas.show',
            'description'   => 'Ve en detalle cada marca del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de marca',
            'slug'          => 'marcas.create',
            'description'   => 'Podría crear nuevas marcas en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de marcas',
            'slug'          => 'marcas.edit',
            'description'   => 'Podría editar cualquier dato de una marca del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar marcas',
            'slug'          => 'marcas.destroy',
            'description'   => 'Podría eliminar cualquier marca del sistema',      
        ]);
    }
}
