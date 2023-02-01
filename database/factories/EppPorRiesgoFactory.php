<?php

namespace Database\Factories;

use App\Models\Epp;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EppPorRiesgo>
 */
class EppPorRiesgoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'epp_id' => Epp::all()->random()->id,
            'riesgo_id' => Epp::all()->random()->id,
        ];
    }
}
