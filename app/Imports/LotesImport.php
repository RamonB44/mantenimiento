<?php

namespace App\Imports;

use App\Models\Cultivo;
use Illuminate\Support\Str;
use App\Models\Fundo;
use App\Models\Lote;
use App\Models\Sede;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class LotesImport implements OnEachRow,WithHeadingRow
{
    public function onRow(Row $row)
    {
        //Campos: sede,fundo,lote,codigo,encargado,cultivo
        $sede = Sede::firstOrCreate([
            'sede' => strtoupper($row['sede'])
        ]);

        $encargado = User::firstOrCreate(
            [
                'codigo' => $row['codigo'],
            ],
            [
                'dni' => $row['dni'],
                'name' => strtoupper($row['encargado']),
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

        $role = Role::find(5);

        $encargado->assignRole($role);

        $fundo = Fundo::firstOrCreate(
            ['fundo' => strtoupper($row['fundo'])],
            ['sede_id' => $sede->id]
        );

        $cultivo = Cultivo::firstOrCreate([
            'cultivo' => strtoupper($row['cultivo'])
        ]);

        Lote::firstOrCreate(
            ['lote' => strtoupper($row['lote'])],
            [
                'encargado' => $encargado->id,
                'cultivo_id' => $cultivo->id,
                'fundo_id' => $fundo->id
            ]
        );
    }
}
