<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Ejecutar seeders existentes
        $this->call(CategoriesSeeder::class);
        $this->call(ProductosSeeder::class);
        $this->call(StockSeeder::class);
        // Crear usuarios de prueba
        User::factory(10)->create();
    }
}

