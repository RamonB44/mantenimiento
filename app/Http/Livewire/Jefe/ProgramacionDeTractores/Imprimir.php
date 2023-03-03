<?php

namespace App\Http\Livewire\Jefe\ProgramacionDeTractores;

use App\Models\ProgramacionDeTractor;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;

class Imprimir extends Component
{
    public $open;
    public $fecha;
    public $sede_id;
    public $supervisor_id;
    protected $listeners = ['obtenerSupervisor'];
    public function mount(){
        $this->open = false;
        $this->fecha = date('Y-m-d');
        $this->supervisor_id = 0;
    }

    public function obtenerSupervisor($sede_id,$supervisor_id){
        $this->resetExcept('fecha');
        $this->fecha = date('Y-m-d');
        $this->sede_id = $sede_id;
        $this->supervisor_id = $supervisor_id;
        $this->render();
    }
    public function imprimirProgramacion(){
        if(ProgramacionDeTractor::where('fecha',$this->fecha)->where('esta_anulado',0)->doesntExist()){
            $this->emit('alerta',['center','warning','No existe programacion']);
        }else{
            $titulo = 'Programación del '.$this->fecha.'.pdf';
            $programaciones_am = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno','MAÑANA');
            $programaciones_pm = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno','NOCHE');
            if($this->supervisor_id > 0){
                $programaciones_am = $programaciones_am->where('supervisor',$this->supervisor_id);
                $programaciones_pm = $programaciones_pm->where('supervisor',$this->supervisor_id);
            }
            $programaciones_am = $programaciones_am->where('esta_anulado',0)->get();
            $programaciones_pm = $programaciones_pm->where('esta_anulado',0)->get();
            $data = [
                'programaciones_am' => $programaciones_am,
                'programaciones_pm' => $programaciones_pm,
                'fecha' => Carbon::parse($this->fecha)->isoFormat('dddd').','.Carbon::parse($this->fecha)->isoFormat(' DD').' de '.Carbon::parse($this->fecha)->isoFormat(' MMMM').' del '.Carbon::parse($this->fecha)->isoFormat(' Y'),
            ];
            $pdfContent = Pdf::loadView('livewire.supervisor.programacion-de-tractores.pdf.programacion-de-tractores', $data)->setPaper('a4', 'landscape')->output();

            return response()->streamDownload(
                fn () => print($pdfContent),
                $titulo
            );
        }
    }
    public function render()
    {
        return view('livewire.jefe.programacion-de-tractores.imprimir');
    }
}
