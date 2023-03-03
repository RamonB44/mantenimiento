<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TractorScheduleExport implements FromCollection,ShouldAutoSize,WithHeadings,WithStyles
{
    private $fecha;
    private $sede_id;
    private $supervisor_id;
    public function __construct($fecha,$sede,$supervisor_id){
        $this->fecha = $fecha;
        $this->sede = $sede;
        $this->supervisor_id = $supervisor_id;
    }
    public function headings(): array
    {
        return [
            'Sede',
            'Fecha',
            'Turno',
            'Fundo',
            'Lote',
            'Cultivo',
            'Supervisor',
            'Código',
            'Tractorista',
            'Tractor',
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
        $programacion = DB::table('vista_programacion_de_tractores')->select('sede','fecha','turno','fundo','lote','cultivo','supervisor','codigo_tractorista','tractorista','tractor','implementos','labor');
        if($this->supervisor_id > 0){
            $programacion = $programacion->where('supervisor_id',$this->supervisor_id);
        }else{
            $programacion = $programacion->where('sede_id',$this->sede_id);
        }
        $programacion = $programacion->where('fecha',$this->fecha)->orderBy('turno')->get();
        return $programacion;
    }
}
