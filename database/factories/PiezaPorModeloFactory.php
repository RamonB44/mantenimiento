<?php

namespace Database\Factories;

use App\Models\Componente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PiezaPorModelo>
 */
class PiezaPorModeloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pieza' => Componente::where('es_pieza',0)->get(),
            'componente_id' => Componente::where('ez_pieza',1)->get(),
        ];
    }
}
