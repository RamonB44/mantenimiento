<?php

namespace Database\Factories;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarea>
 */
class TareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tarea' => $this->faker->unique()->lexify('????????'),
            'articulo_id' => Articulo::where('tipo','COMPONENTE')->get()->random()->id,
            'tipo' => $this->faker->randomElement(['RUTINARIO','PREVENTIVO']),
            'tiempo_estimado' => 30,
        ];
    }
}
