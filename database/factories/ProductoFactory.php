<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

     protected $model = Producto::class;

    public function definition()
    {
        return [
            "nombre" => $this->faker->word(20),
            "precio_con_impuesto" => rand(1, 50) * 12.35,
            "procentaje_impuesto" => rand(1, 18)

        ];
    }
}
