<?php

namespace App\Imports;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Models\CentroDeCosto;
use App\Models\Implemento;
use App\Models\ModeloDelImplemento;
use App\Models\Sede;
use App\Models\User;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;


class ImplementsImport implements OnEachRow,WithHeadingRow
{
    public function onRow(Row $row)
    {
        $modelo = ModeloDelImplemento::firstOrCreate([
            'modelo_de_implemento' => strtoupper($row['modelo'])
        ]);

        $sede = Sede::firstOrCreate([
            'sede' => strtoupper($row['sede'])
        ]);

        $responsable = User::firstOrCreate(
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

        $role = Role::find(3);

        $responsable->assignRole($role);

        $ceco = CentroDeCosto::firstOrCreate(
            [
            'codigo' => $row['codigo_ceco'],
            ],
            [
                'descripcion' => $row['descripcion_ceco'],
                'sede_id' => $sede->id,
                'monto'=> $row['monto_ceco']
            ]
        );

        Implemento::firstOrCreate(
            [
                'modelo_del_implemento_id' => $modelo->id,
                'numero' => $row['numero'],
            ],
            [
                'horas_de_uso' => $row['horas'],
                'responsable' => $responsable->id,
                'sede_id' => $sede->id,
                'centro_de_costo_id' => $ceco->id
            ]
        );

    }
}
