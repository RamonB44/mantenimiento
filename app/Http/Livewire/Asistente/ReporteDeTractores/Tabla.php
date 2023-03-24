<?php

namespace App\Http\Livewire\Asistente\ReporteDeTractores;

use App\Models\ReporteDeTractor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $reporte_id;

    public $fecha;
    public $turno;
    public $fundo;
    public $lote;
    public $tractorista;
    public $tractor;
    public $implemento;
    public $labor;
    public $search;

    protected $listeners = ['render','filtrar'];

    public function mount(){
        $this->reporte_id = 0;
        $this->fecha =  Carbon::yesterday()->isoFormat('Y-MM-DD');
        $this->turno = "MAÑANA";
        $this->fundo = 0;
        $this->lote = 0;
        $this->tractorista = 0;
        $this->tractor = 0;
        $this->implemento = 0;
        $this->labor = 0;
    }

    public function seleccionar($id){
        if($this->reporte_id != $id){
            $this->reporte_id = $id;
            $this->emitTo('asistente.reporte-de-tractores.botones','obtenerReporte',$id);
        }
    }

    public function updatedFecha(){
        $this->resetPage();
    }
    public function updatedTurno(){
        $this->resetPage();
    }

    public function filtrar($fundo,$lote,$tractorista,$tractor,$implemento,$labor){
        $this->resetPage();
        $this->fundo = $fundo;
        $this->lote = $lote;
        $this->tractorista = $tractorista;
        $this->tractor = $tractor;
        $this->implemento = $implemento;
        $this->labor = $labor;
    }

    public function render()
    {
        if($this->fecha != ''){
            $this->fecha = date('Y-m-d');
        }

        $reporte_de_tractores = ReporteDeTractor::where('sede_id',Auth::user()->sede_id)->where('esta_anulado',0)
                                                ->whereHas('ProgramacionDeTractor',function($q){
                                                    $q->where('fecha',$this->fecha)->where('turno',$this->turno);
                                                });

        $reporte_de_tractores = $reporte_de_tractores->search()->latest()->paginate(6);

        return view('livewire.asistente.reporte-de-tractores.tabla',compact('reporte_de_tractores'));
    }
}
