<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\ProgramacionDeTractor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $programacion_id;

    public $fecha;
    public $turno;
    public $fundo;
    public $lote;
    public $tractorista;
    public $tractor;
    public $implemento;
    public $labor;

    protected $listeners = ['render','filtrar'];

    public function mount(){
        $this->programacion_id = 0;
        $this->fecha = "";
        $this->turno = "";
        $this->fundo = 0;
        $this->lote = 0;
        $this->tractorista = 0;
        $this->tractor = 0;
        $this->implemento = 0;
        $this->labor = 0;
    }

    public function seleccionar($id){
        $this->programacion_id = $id;
        $this->emitTo('supervisor.programacion-de-tractores.botones','obtenerProgramacion',$id);
    }

    public function filtrar($fecha,$turno,$fundo,$lote,$tractorista,$tractor,$implemento,$labor){
        $this->resetPage();
        $this->fecha = $fecha;
        $this->turno = $turno;
        $this->fundo = $fundo;
        $this->lote = $lote;
        $this->tractorista = $tractorista;
        $this->tractor = $tractor;
        $this->implemento = $implemento;
        $this->labor = $labor;
    }

    public function render()
    {
        $programacion_de_tractores = ProgramacionDeTractor::where('supervisor',Auth::user()->id)->where('esta_anulado',0);

        if($this->fecha != "") {
            $programacion_de_tractores->where('fecha',$this->fecha);
        }

        if($this->turno != "") {
            $programacion_de_tractores->where('turno',$this->turno);
        }

        if($this->lote > 0){
            $programacion_de_tractores->where('lote_id',$this->lote);
        }else if($this->fundo > 0){
            $programacion_de_tractores->whereHas('Lote',function($q){
                $q->where('fundo_id',$this->fundo);
            });
        }

        if($this->tractorista > 0) {
            $programacion_de_tractores->where('tractorista',$this->tractorista);
        }

        if($this->tractor > 0) {
            $programacion_de_tractores->where('tractor_id',$this->tractor);
        }

        if($this->implemento > 0) {
            $programacion_de_tractores->whereHas('ImplementoProgramacion',function($q){
                $q->where('implemento_id',$this->implemento);
            });
        }

        if($this->labor > 0) {
            $programacion_de_tractores->where('labor_id',$this->labor);
        }

        $programacion_de_tractores = $programacion_de_tractores->orderBy('id','desc')->paginate(6);

        return view('livewire.supervisor.programacion-de-tractores.tabla',compact('programacion_de_tractores'));
    }
}
