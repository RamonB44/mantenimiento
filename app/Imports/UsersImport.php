<?php

namespace App\Imports;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Models\Sede;
use App\Models\User;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class UsersImport implements OnEachRow,WithHeadingRow
{
    public function onRow(Row $row)
    {
        //Campos: sede, codigo_operario, nombre, rol
        $sede = Sede::firstOrCreate([
            'sede' => strtoupper($row['sede'])
        ]);

       $usuario = User::firstOrCreate(
            [
                'codigo' => $row['codigo_operario'],
            ],
            [
                'name' => strtoupper($row['nombre']),
                'email' => null,
                'email_verified_at' => null,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'is_admin' => false,
                'sede_id' => $sede->id,
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,
            ]
        );

        if($row['rol'] != ""){
            $role = Role::where('name', $row['rol'])->first();
            $usuario->assignRole($role);
        }
    }
}
