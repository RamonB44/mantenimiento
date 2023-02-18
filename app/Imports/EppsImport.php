<?php

namespace App\Imports;

use App\Models\Epp;
use App\Models\Riesgo;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class EppsImport implements OnEachRow
{
    public function onRow(Row $row)
    {
        $riesgo = Riesgo::firstOrCreate([
            'riesgo' => $row['riesgo']
        ]);

        $epp = Epp::firstOrCreate([
            'epp' => $row['epp']
        ]);

        Epp::firstOrCreate([
            'epp_id' => $epp->id,
            'riesgo_id' => $riesgo->id,
        ]);
    }
}
