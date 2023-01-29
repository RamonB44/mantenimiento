<?php

namespace Database\Factories;

use App\Models\ModeloDeTractor;
use App\Models\Sede;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tractor>
 */
class TractorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'modelo_de_tractor_id' => ModeloDeTractor::all()->random()->id,
            'numero_de_tractor' => $this->faker->unique()->randomNumber(3,false),
            'horometro' => $this->faker->unique()->randomFloat(2,30,300),
            'sede_id' => Sede::all()->random()->id,
        ];
    }
}
