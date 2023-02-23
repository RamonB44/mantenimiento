<?php

namespace Database\Factories;

use App\Models\Cultivo;
use App\Models\Fundo;
use App\Models\User;
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
            'encargado' => 5,
            'cultivo_id' => Cultivo::all()->random()->id,
            'fundo_id' => Fundo::all()->random()->id,
        ];
    }
}
