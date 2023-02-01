<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Componente>
 */
class ComponenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'articulo_id' => '',
            'componente' => $this->faker->unique()->lexify('??????'),
            'sistema' => $this->faker->randomElement(['HIDRAÚLICO','MECÁNICO','NEUMÁTICO','OLEO HIDRAÚLICO','ELECTRÓNICO']),
        ];
    }
}
