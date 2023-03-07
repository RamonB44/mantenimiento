<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\ProgramacionDeTractor;
use Carbon\Carbon;
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
    public $fecha_programacion;

    protected $listeners = ['render','filtrar','obtenerFecha'];

    public function mount(){
        $this->programacion_id = 0;
        $this->fecha = date('Y-m-d');
        $this->turno = "";
        $this->fundo = 0;
        $this->lote = 0;
        $this->tractorista = 0;
        $this->tractor = 0;
        $this->implemento = 0;
        $this->labor = 0;
        $this->fecha_programacion = Carbon::parse($this->fecha)->isoFormat('dddd').','.Carbon::parse($this->fecha)->isoFormat(' DD').' de '.Carbon::parse($this->fecha)->isoFormat(' MMMM').' del '.Carbon::parse($this->fecha)->isoFormat(' Y');
    }

    public function seleccionar($id){
        if($this->programacion_id != $id){
            $this->programacion_id = $id;
            $this->emitTo('supervisor.programacion-de-tractores.botones','obtenerProgramacion',$id);
        }
    }

    public function obtenerFecha($fecha){
        $this->resetPage();
        $this->fecha_programacion = Carbon::parse($fecha)->isoFormat('dddd').','.Carbon::parse($fecha)->isoFormat(' DD').' de '.Carbon::parse($fecha)->isoFormat(' MMMM').' del '.Carbon::parse($fecha)->isoFormat(' Y');
        $this->fecha = $fecha;
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
        $this->fecha_programacion = Carbon::parse($this->fecha)->isoFormat('dddd').','.Carbon::parse($this->fecha)->isoFormat(' DD').' de '.Carbon::parse($this->fecha)->isoFormat(' MMMM').' del '.Carbon::parse($fecha)->isoFormat(' Y');
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

        if($this->fecha == ""){
            $total_tractores = 0;
            $total_implementos = 0;
        }else{
            $total_tractores = $programacion_de_tractores->count();
            $implementos_por_programacion = $programacion_de_tractores->withCount('ImplementoProgramacion')->get();
            $total_implementos = 0;
            foreach($implementos_por_programacion as $implemento_programacion){
                $total_implementos += $implemento_programacion->implemento_programacion_count;
            }
        }

        $programacion_de_tractores = $programacion_de_tractores->latest()->paginate(6);

        return view('livewire.supervisor.programacion-de-tractores.tabla',compact('programacion_de_tractores','total_implementos','total_tractores'));
    }
}
