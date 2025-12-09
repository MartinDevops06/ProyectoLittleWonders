<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([

            [
                'name' => 'Lactancia',
                'description' => 'Productos relacionados con la lactancia materna y apoyo para la alimentación del bebé.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Maternidad',
                'description' => 'Artículos esenciales para madres durante el embarazo, parto y postparto.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Ropa de Bebé',
                'description' => 'Prendas y accesorios para recién nacidos y bebés de hasta 2 años.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Movilidad',
                'description' => 'Carritos, cochecitos, sillas y accesorios para transportar al bebé con seguridad.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Tecnología para Bebés',
                'description' => 'Monitores, cámaras, termómetros y dispositivos electrónicos enfocados en el cuidado infantil.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
