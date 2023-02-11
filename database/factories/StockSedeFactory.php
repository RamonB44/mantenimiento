<?php

namespace Database\Factories;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockSede>
 */
class StockSedeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'articulo_id' => Articulo::doesnthave('StockSede')->get()->random()->id,
            'cantidad'  => $this->faker->randomFloat(0,1,10),
            'sede_id' => 1
        ];
    }
}
