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
    private $sede;

    public function __construct($fecha,$sede = 0){
        $this->fecha = $fecha;
        $this->sede = $sede > 0 ? $sede : Auth::user()->sede_id;
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
            'Código',
            'Tractorista',
            'Tractor',
            'Horometro Inicial',
            'Horometro Final',
            'Implementos',
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
        return DB::table('vista_reporte_de_tractores')->select('sede','fecha','turno','fundo','lote','correlativo','codigo_tractorista','tractorista','tractor','horometro_inicial','horometro_final','implementos','labor')->where('sede_id',$this->sede)->where('fecha',$this->fecha)->orderBy('turno')->get();
    }
}
