<?php

namespace App\Imports;

use App\Models\CentroDeCosto;
use App\Models\Sede;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithGroupedHeadingRow;
use Maatwebsite\Excel\Row;

class CecosImport implements OnEachRow,WithGroupedHeadingRow
{
    public function onRow(Row $row)
    {
        //Campos: sede, codigo_ceco,monto_ceco
        $sede = Sede::firstOrCreate([
            'sede' => strtoupper($row['sede'])
        ]);

        CentroDeCosto::firstOrCreate(
            [
                'codigo' => $row['codigo_ceco'],
            ],
            [
                'sede_id' => $sede->id,
                'monto'=> $row['monto_ceco'] == "" ? 0 : $row['monto_ceco'],
            ]
        );
    }
}
