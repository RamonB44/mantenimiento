<?php

namespace Database\Factories;

use App\Models\Articulo;
use App\Models\PiezaPorModelo;
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
            'pieza' => Articulo::where('tipo','PIEZA')->get()->random()->id,
            'articulo_id' => Articulo::where('tipo','COMPONENTE')->get()->random()->id,
        ];
    }
}
