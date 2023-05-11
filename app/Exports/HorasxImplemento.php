<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class HorasxImplemento implements FromCollection
{
    private $idSede;
    private $idSupervisor;
    private $idMimplemento;

    private $year;
    private $mes;
    private $semana;

    public function __construct($idSede, $idSupervisor, $year, $mes, $semana){
        $this->idSede = $idSede;
        $this->idSupervisor = $idSupervisor;
        $this->year = $year;
        $this->mes = $mes;
        $this->semana = $semana;
    }

    public function headings(): array
    {
        return [
            'Sede',
            'Supervisor',
            'Mes',
            'N° Semana',
            'Dia',
            'Implementos'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }


}
