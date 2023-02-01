<?php

namespace Database\Factories;

use App\Models\UnidadDeMedida;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class ArticuloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->numerify('######'),
            'articulo' => $this->faker->lexify('????????'),
            'unidad_de_medida_id' => UnidadDeMedida::all()->random()->id,
            'precio_estimado' => $this->faker->randomFloat(2,500,5000),
            'tipo' => 'COMPONENTE',
            'tiempo_de_vida' => $this->faker->randomFloat(2,500,1500),
        ];
    }
}
