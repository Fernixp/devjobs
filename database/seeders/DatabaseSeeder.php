<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SalarioSeeder::class); //llamando a la clase SalarioSeeder.php
        $this->call(CategoriasSeeder::class); //llamando a la clase CategoriasSeeder
    }
}
