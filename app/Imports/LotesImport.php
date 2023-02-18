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
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function onRow(Row $row)
    {
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
