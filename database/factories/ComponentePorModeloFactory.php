<?php

namespace Database\Factories;

use App\Models\Articulo;
use App\Models\ComponentePorModelo;
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
            'articulo_id' => Articulo::doesnthave('ComponentePorModelo')->where('tipo','COMPONENTE')->get()->random()->id,
            'modelo_id' => ModeloDelImplemento::all()->random()->id,
            'sistema' => $this->faker->randomElement(['HIDRAÚLICO','MECÁNICO','NEUMÁTICO','OLEO HIDRAÚLICO','ELECTRÓNICO','ELÉCTRICO']),
        ];
    }
}
