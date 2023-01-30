<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $operador = Role::create([
            'name' => 'operador',
            'guard_name' => 'operador',
        ]);

        $planificador = Role::create([
            'name' => 'planificador',
            'guard_name' => 'planificador',
        ]);

        $supervisor = Role::create([
            'name' => 'supervisor',
            'guard_name' => 'supervisor',
        ]);

        Permission::create([
            'name' => 'supervisor.programacion-de-tractores',
            'guard_name' => 'supervisor',
        ])->syncRoles(['supervisor']);

        Permission::create([
            'name' => 'asistente.reporte-de-tractores',
            'guard_name' => 'asistente',
        ])->syncRoles(['asistente']);

        Permission::create([
            'name' => 'operador.solicitud-de-materiales',
            'guard_name' => 'operador',
        ])->syncRoles(['operador']);

        Permission::create([
            'name' => 'planificador.validar-pedidos',
            'guard_name' => 'planificador',
        ])->syncRoles(['planificador']);

        Permission::create([
            'name' => 'jefe.dashboard',
            'guard_name' => 'jefe',
        ])->syncRoles(['jefe']);

        $users = User::all();
        $user1 = $users->find(1);

        $role1 = Role::find(1);

        $user1->assignRole($role1);

        $users = User::all();
        $user2 = $users->find(2);

        $role2 = Role::find(2);

        $user2->assignRole($role2);

        $users = User::all();
        $user3 = $users->find(3);

        $role3 = Role::find(3);

        $user3->assignRole($role3);

        $users = User::all();
        $user4 = $users->find(4);

        $role4 = Role::find(4);

        $user4->assignRole($role4);

        $users = User::all();
        $user5 = $users->find(5);

        $role5 = Role::find(5);

        $user5->assignRole($role5);


    }
}
