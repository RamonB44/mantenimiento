<?php

namespace Database\Factories;

use App\Models\Tarea;
use App\Models\Articulo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticuloParaTarea>
 */
class ArticuloParaTareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tarea_id' => Tarea::all()->random()->id,
            'articulo_id' => Articulo::all()->random()->id,
        ];
    }
}
