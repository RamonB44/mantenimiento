<?php

namespace Database\Factories;

use App\Models\Sede;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CentroDeCosto>
 */
class CentroDeCostoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->numerify('######'),
            'descripcion' => $this->faker->lexify('????????'),
            'sede_id' => 1,
            'monto'=> 0
        ];
    }
}
