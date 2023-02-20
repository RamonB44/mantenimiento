<?php

namespace Database\Factories;

use App\Models\CentroDeCosto;
use App\Models\ModeloDelImplemento;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Implemento>
 */
class ImplementoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'modelo_del_implemento_id' => ModeloDelImplemento::all()->random()->id,
            'numero' => $this->faker->unique()->randomNumber(3,false),
            'horas_de_uso' => $this->faker->randomFloat(2,30,300),
            'responsable' => $this->faker->randomElement([1,3]),
            'sede_id' => 1,
            'centro_de_costo_id' => CentroDeCosto::all()->random()->id
        ];
    }
}
