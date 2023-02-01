<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\ProgramacionDeTractor;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class Imprimir extends Component
{
    public $open = false;

    public $fecha;

    protected $listeners = ['abrir_modal'];

    public function mount(){
        $this->fecha = date('Y-m-d',strtotime(date('Y-m-d')."+1 days"));
    }

    public function abrir_modal(){
        $this->open =true;
    }

    public function imprimirProgramacion(){
        $titulo = 'Programación del '.$this->fecha.'.pdf';
        if(ProgramacionDeTractor::where('fecha',$this->fecha)->where('esta_anulado',0)->doesntExist()){
            $this->emit('alerta',['center','warning','No existe programacion']);
        }else{
            $programaciones_am = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno','MAÑANA')->where('esta_anulado',0)->get();
            $programaciones_pm = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno','NOCHE')->where('esta_anulado',0)->get();
            $data = [
                'programaciones_am' => $programaciones_am,
                'programaciones_pm' => $programaciones_pm,
                'fecha' => $this->fecha,
            ];
            $pdfContent = PDF::loadView('livewire.supervisor.programacion-de-tractores.pdf.programacion-de-tractores', $data)->setPaper('a4', 'landscape')->output();

            return response()->streamDownload(
                fn () => print($pdfContent),
                $titulo
            );
        }
    }

    public function render()
    {
        return view('livewire.supervisor.programacion-de-tractores.imprimir');
    }
}
