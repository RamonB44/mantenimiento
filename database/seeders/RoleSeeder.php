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

        User::find(1)->assignRole($operario);
        User::find(2)->assignRole($asistente);
        User::find(3)->assignRole($operario);
        User::find(4)->assignRole($planificador);
        User::find(5)->assignRole($supervisor);


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

        /*$users = User::all();
        $user1 = $users->find(1);

        $role1 = Role::find(1);

        $user1->assignRole($role1);

        $user2 = $users->find(2);

        $role2 = Role::find(2);

        $user2->assignRole($role2);

        $user3 = $users->find(3);

        $role3 = Role::find(3);

        $user3->assignRole($role3);

        $user4 = $users->find(4);

        $role4 = Role::find(4);

        $user4->assignRole($role4);

        $user5 = $users->find(5);

        $role5 = Role::find(5);

        $user5->assignRole($role5);
*/

    }
}
