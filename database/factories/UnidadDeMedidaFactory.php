<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UnidadDeMedida>
 */
class UnidadDeMedidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'unidad_de_medida' => $this->faker->unique()->lexify('????????'),
            'abreviacion' => $this->faker->unique()->lexify('???'),
        ];
    }
}
