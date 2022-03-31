<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        Producto::create([
            "nombre" => "Producto 1",
            "precio_con_impuesto" => 123.45,
            "procentaje_impuesto" => 5
        ]);

        Producto::create([
            "nombre" => "Producto 2",
            "precio_con_impuesto" => 45.65,
            "procentaje_impuesto" => 15
        ]);

        Producto::create([
            "nombre" => "Producto 3",
            "precio_con_impuesto" => 39.73,
            "procentaje_impuesto" => 12
        ]);

        Producto::create([
            "nombre" => "Producto 4",
            "precio_con_impuesto" => 250.00,
            "procentaje_impuesto" => 8
        ]);

        Producto::create([
            "nombre" => "Producto 5",
            "precio_con_impuesto" => 59.35,
            "procentaje_impuesto" => 10
        ]);

        Producto::factory(50)->create();
    }
}
