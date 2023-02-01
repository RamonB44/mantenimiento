<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Articulo;
use App\Models\CentroDeCosto;
use App\Models\Componente;
use App\Models\ComponentePorModelo;
use App\Models\Epp;
use App\Models\Fundo;
use App\Models\Implemento;
use App\Models\Labor;
use App\Models\Lote;
use App\Models\ModeloDelImplemento;
use App\Models\ModeloDeTractor;
use App\Models\PiezaPorModelo;
use App\Models\Riesgo;
use App\Models\Sede;
use App\Models\Tarea;
use App\Models\Tractor;
use App\Models\UnidadDeMedida;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        UnidadDeMedida::factory(10)->create();
        Labor::factory(7)->create();
        Epp::factory(20)->create();
        Riesgo::factory(4)->create();
        Sede::factory(2)->has(Fundo::factory()->count(2)->has(Lote::factory()->count(2)))->has(User::factory()->count(3))->has(CentroDeCosto::factory()->count(2))->create();
        ModeloDeTractor::factory(3)->has(Tractor::factory()->count(7))->create();
        Articulo::factory(6)->has(Componente::factory()->count(1)->has(Tarea::factory()->count(5)))->create();
        ModeloDelImplemento::factory(4)->has(Implemento::factory()->count(5))->create();
        ComponentePorModelo::factory(10)->create();
        $this->call([
            RoleSeeder::class
        ]);

    }
}
