<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Articulo;
use Spatie\Permission\Models\Role;
use App\Models\CentroDeCosto;
use App\Models\ArticuloParaTarea;
use App\Models\ComponentePorModelo;
use App\Models\Cultivo;
use App\Models\PiezaPorModelo;
use App\Models\Epp;
use App\Models\Fundo;
use App\Models\Implemento;
use App\Models\Labor;
use App\Models\Lote;
use App\Models\ModeloDelImplemento;
use App\Models\ModeloDeTractor;
use App\Models\Riesgo;
use App\Models\Sede;
use App\Models\Sistema;
use App\Models\StockOperario;
use App\Models\StockSede;
use App\Models\Tarea;
use App\Models\Tractor;
use App\Models\UnidadDeMedida;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //UnidadDeMedida::factory(10)->create();
        //Cultivo::factory(4)->create();
        //Labor::factory(7)->create();
        //Epp::factory(20)->create();
        //Riesgo::factory(4)->create();
        //Sistema::factory(5)->create();
        //Sede::factory(1)->has(User::factory()->count(10))->has(Fundo::factory()->count(3)->has(Lote::factory()->count(2)))->has(CentroDeCosto::factory()->count(2))->create();
        /*$this->call([
            RoleSeeder::class,
            FechaDePedidoSeeder::class,
            DetalleMontoCecoSeeder::class
        ]);*/
        //ModeloDeTractor::factory(3)->has(Tractor::factory()->count(7))->create();
        //Articulo::factory(6)->create(['tipo' => 'FUNGIBLE']);
        //Articulo::factory(4)->create(['tipo' => 'HERRAMIENTA']);
        //Articulo::factory(36)->has(Tarea::factory()->count(5)->has(ArticuloParaTarea::factory()->count(4)))->create();
        //ModeloDelImplemento::factory(4)->has(Implemento::factory()->count(3))->has(ComponentePorModelo::factory()->count(3))->create();
        //Articulo::factory(36)->has(PiezaPorModelo::factory()->count(1))->create(['tipo' => 'PIEZA']);
        //StockSede::factory(40)->create();
        //StockOperario::factory(35)->create();

        Sede::create([
            'sede' => 'CHINCHA'
        ]);

        $usuario = User::create([
            'codigo' => '442479',
            'dni' => '71883064',
            'name' => 'LURITA MENDOZA GIOVANNI DUVAN',
            'email' => null,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'is_admin' => false,
            'sede_id' => 2,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);

        /*$jefe = Role::create([
            'name' => 'jefe',
            'guard_name' => 'jefe',
        ]);

        $asistente = Role::create([
            'name' => 'asistente',
            'guard_name' => 'asistente',
        ]);

        $operario = Role::create([
            'name' => 'operario',
            'guard_name' => 'operario',
        ]);

        $planificador = Role::create([
            'name' => 'planificador',
            'guard_name' => 'planificador',
        ]);

        $supervisor = Role::create([
            'name' => 'supervisor',
            'guard_name' => 'supervisor',
        ]);*/
        $planificador = Role::find(4);
        $usuario->assignRole($planificador);
        /*$solicitante = Role::create([
            'name' => 'solicitante',
            'guard_name' => 'solicitante',
        ]);*/
    }
}
