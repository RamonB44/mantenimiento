<?php

namespace Database\Factories;

use App\Models\Articulo;
use App\Models\ComponentePorModelo;
use App\Models\ModeloDelImplemento;
use App\Models\Sistema;
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
            'articulo_id' => Articulo::where('tipo','COMPONENTE')->whereDoesnthave('ComponentePorModelo')->get()->random()->id,
            'modelo_id' => ModeloDelImplemento::all()->random()->id,
            'sistema_id' => Sistema::all()->random()->id,
        ];
    }
}
