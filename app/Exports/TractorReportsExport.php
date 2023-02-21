<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TractorReportsExport implements FromCollection,ShouldAutoSize,WithHeadings,WithStyles
{
    
    private $fecha;

    public function __construct($fecha){
        $this->fecha = $fecha;
    }

    public function headings(): array
    {
        return [
            'Sede',
            'Fecha',
            'Turno',
            'Fundo',
            'Lote',
            'Correlativo',
            'Tractorista',
            'Tractor',
            'Horometro Inicial',
            'Horometro Final',
            'Implemento',
            'Labor',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => [
                        'font' => [
                                    'bold' => true,
                                    'size'=> 12
                                ]
                    ],
        ];
    }

    public function collection()
    {
        return DB::table('vista_reporte_de_tractores')->select('sede','fecha','turno','fundo','lote','correlativo','name','tractor','horometro_inicial','horometro_final','implemento','labor')->where('sede_id',Auth::user()->sede_id)->where('fecha',$this->fecha)->orderBy('turno')->get();
    }
}
