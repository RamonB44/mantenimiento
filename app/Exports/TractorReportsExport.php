<?php

namespace App\Exports;

use App\Models\ReporteDeTractor;
use Maatwebsite\Excel\Concerns\FromCollection;

class TractorReportsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ReporteDeTractor::all();
    }
}
