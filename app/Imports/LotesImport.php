<?php

namespace App\Imports;

use App\Models\Fundo;
use App\Models\Lote;
use App\Models\Sede;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class LotesImport implements OnEachRow,WithHeadingRow
{
    public function onRow(Row $row)
    {
        //Campos: sede,fundo,lote
        $sede = Sede::firstOrCreate([
            'sede' => strtoupper($row['sede'])
        ]);

        $fundo = Fundo::firstOrCreate(
            ['fundo' => strtoupper($row['fundo'])],
            ['sede_id' => $sede->id]
        );

        Lote::firstOrCreate(
            ['lote' => strtoupper($row['lote'])],
            ['fundo_id' => $fundo->id]
        );
    }
}
