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
            'numero_del_implemento' => $this->faker->unique()->randomNumber(3,false),
            'horas_de_uso' => $this->faker->randomFloat(2,30,300),
            'responsable' => User::all()->random()->id,
            'sede_id' => Sede::all()->random()->id,
            'centro_de_costo_id' => CentroDeCosto::all()->random()->id
        ];
    }
}
