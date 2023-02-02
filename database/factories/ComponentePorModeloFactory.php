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
        $componentes = ComponentePorModelo::all();

        $articulos_usados = [];

        foreach($componentes as $componente){
            array_push($articulos_usados,$componente->articulo_id);
        }
        return [
            'articulo_id' => Articulo::whereNotIn('id',$articulos_usados)->get()->random()->id,
            'modelo_id' => ModeloDelImplemento::all()->random()->id,
            'sistema' => $this->faker->randomElement(['HIDRAÚLICO','MECÁNICO','NEUMÁTICO','OLEO HIDRAÚLICO','ELECTRÓNICO','ELÉCTRICO']),
        ];
    }
}
