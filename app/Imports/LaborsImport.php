<?php

namespace App\Imports;

use App\Models\Labor;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class LaborsImport implements OnEachRow,WithHeadingRow
{
    public function onRow(Row $row)
    {
        Labor::firstOrCreate([
            'labor' => strtoupper($row(['labor']))
        ]);
    }
}
