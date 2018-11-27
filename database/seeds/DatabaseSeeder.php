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
        $this->call(tipo_pagosTableSeeder::class);
        $this->call(tipo_facturasTableSeeder::class);
        $this->call(tipo_domiciliosTableSeeder::class);
        $this->call(provinciasTableSeeder::class);
        $this->call(LocalidadesTableSeeder::class);
//        $this->call(NotasTableSeeder::class);
    }
}
