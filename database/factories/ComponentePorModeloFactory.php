<?php

namespace Database\Factories;

use App\Models\Componente;
use App\Models\ModeloDelImplemento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComponentePorModelo>
 */
class ComponentePorModeloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'componente_id' => Componente::all()->random()->id,
            'modelo_id' => ModeloDelImplemento::all()->random()->id,
        ];
    }
}
