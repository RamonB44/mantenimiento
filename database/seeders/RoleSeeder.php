<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jefe = Role::create([
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
        ]);
        $solicitante = Role::create([
            'name' => 'solicitante',
            'guard_name' => 'solicitante',
        ]);
        User::find(1)->assignRole($operario);
        User::find(2)->assignRole($asistente);
        User::find(3)->assignRole($operario);
        User::find(4)->assignRole($planificador);
        User::find(5)->assignRole($supervisor);
        User::find(6)->assignRole($solicitante);


        Permission::create([
            'name' => 'supervisor.programacion-de-tractores',
            'guard_name' => 'supervisor',
        ])->syncRoles(['supervisor']);

        Permission::create([
            'name' => 'asistente.reporte-de-tractores',
            'guard_name' => 'asistente',
        ])->syncRoles(['asistente']);

        Permission::create([
            'name' => 'operario.solicitud-de-materiales',
            'guard_name' => 'operario',
        ])->syncRoles(['operario']);

        Permission::create([
            'name' => 'planificador.validar-pedidos',
            'guard_name' => 'planificador',
        ])->syncRoles(['planificador']);

        Permission::create([
            'name' => 'jefe.dashboard',
            'guard_name' => 'jefe',
        ])->syncRoles(['jefe']);

    }
}
