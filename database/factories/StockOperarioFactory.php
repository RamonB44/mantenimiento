<?php

namespace Database\Factories;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockOperario>
 */
class StockOperarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 3,
            'articulo_id' => Articulo::doesnthave('StockOperario')->get()->random()->id,
            'cantidad'  => $this->faker->randomFloat(0,0,5),
            'sede_id' => 1
        ];
    }
}
