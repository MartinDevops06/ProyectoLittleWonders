<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener todos los productos existentes
        $productos = DB::table('productos')->get();

        foreach ($productos as $producto) {
            DB::table('stock')->insert([
                'producto_id' => $producto->id,
                'quantity' => rand(5, 50), // Cantidad aleatoria de stock
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
