<?php

namespace App\Imports;

use App\Models\ModeloDeTractor;
use App\Models\Sede;
use App\Models\Tractor;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class TractorsImport implements OnEachRow,WithHeadingRow
{
    public function onRow(Row $row)
    {
        $modelo = ModeloDeTractor::firstOrCreate([
            'modelo_de_tractor' => strtoupper($row['modelo'])
        ]);

        $sede = Sede::firstOrCreate([
            'sede' => strtoupper($row['sede'])
        ]);

        Tractor::firstOrCreate(
            [
                'modelo_de_tractor_id' => $modelo->id,
                'numero' => $row['numero'],
            ],
            [
                'horometro' => $row['horometro'],
                'sede_id' => $sede->id
            ]
        );
    }
}
