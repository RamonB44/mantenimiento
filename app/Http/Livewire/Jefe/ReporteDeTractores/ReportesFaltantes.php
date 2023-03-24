<?php

namespace App\Http\Livewire\Jefe\ReporteDeTractores;

use App\Models\ProgramacionDeTractor;
use Livewire\Component;

class ReportesFaltantes extends Component
{
    public $open;
    public $sede_id;
    public $fecha;
    public $turno;

    protected $listeners = ['abrirModal'];

    public function mount(){
        $this->open = false;
        $this->sede_id = 0;
        $this->fecha = "";
        $this->turno = "";
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->sede_id = 0;
            $this->fecha = "";
            $this->turno = "";
        }
    }

    public function abrirModal($sede_id,$fecha,$turno){
        $this->sede_id = $sede_id;
        $this->fecha = $fecha;
        $this->turno = $turno;
        $this->open = true;
    }

    public function render()
    {
        $tractores_no_reportados = [];
        if($this->sede_id > 0 && $this->fecha != ""){
            $tractores_no_reportados  = ProgramacionDeTractor::doesntHave('ReporteDeTractor')->where('sede_id',$this->sede_id)->where('fecha',$this->fecha)->where('turno',$this->turno)->with(['tractor'])->select('tractor_id')->get();
        }
        return view('livewire.jefe.reporte-de-tractores.reportes-faltantes',compact('tractores_no_reportados'));
    }
}
