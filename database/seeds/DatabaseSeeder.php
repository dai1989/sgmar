<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OptionsTableSeeder::class);
        
        $this->call(UsersTableSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(tipo_contactosTableSeeder::class);
//        $this->call(NotasTableSeeder::class);
    }
}
