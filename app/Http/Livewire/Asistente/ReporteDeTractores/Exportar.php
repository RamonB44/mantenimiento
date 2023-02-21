<?php

namespace App\Http\Livewire\Asistente\ReporteDeTractores;

use App\Exports\TractorReportsExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Exportar extends Component
{
    public $fecha;
    public $open;

    protected $listeners = ['abrirModal'];

    public function mount() {
        $this->fecha = "";
    }

    public function abrirModal(){
        $this->open = true;
    }

    public function exportar() {
        if($this->fecha == ""){
            $this->emit('alerta',['center','warning','Ingrese la fecha']);
        }else{
            return Excel::download(new TractorReportsExport($this->fecha),'Reporte de horas del '.$this->fecha.'.xlsx');
        }
    }

    public function render()
    {
        return view('livewire.asistente.reporte-de-tractores.exportar');
    }
}
