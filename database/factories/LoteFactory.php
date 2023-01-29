<?php

namespace Database\Factories;

use App\Models\Fundo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lote>
 */
class LoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'lote' => $this->faker->unique()->lexify('????????'),
            'fundo_id' => Fundo::all()->random()->id,
        ];
    }
}
