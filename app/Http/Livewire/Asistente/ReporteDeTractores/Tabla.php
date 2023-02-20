<?php

namespace App\Http\Livewire\Asistente\ReporteDeTractores;

use App\Models\ReporteDeTractor;
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

    protected $listeners = ['render','filtrar'];

    public function mount(){
        $this->reporte_id = 0;
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
        $this->reporte_id = $id;
        $this->emitTo('asistente.reporte-de-tractores.botones','obtener_reporte',$id);
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
        $reporte_de_tractores = ReporteDeTractor::where('sede_id',Auth::user()->sede_id)->where('esta_anulado',0);

        
        $reporte_de_tractores->whereHas('ProgramacionDeTractor',function($q){
            if($this->fecha != ''){
                $q->where('fecha',$this->fecha);
            }
            if($this->turno != ""){
                $q->where('turno',$this->turno);
            }
            if($this->lote > 0){
                $q->where('lote_id',$this->lote);
            }else if($this->fundo > 0){
                $q->whereHas('Lote',function($q){
                    $q->where('fundo_id',$this->fundo);
                });
            }
            if($this->tractorista > 0) {
                $q->where('tractorista',$this->tractorista);
            }
            if($this->tractor > 0) {
                $q->where('tractor_id',$this->tractor);
            }
            if($this->implemento > 0) {
                $q->where('implemento_id',$this->implemento);
            }
            if($this->labor > 0) {
                $q->where('labor_id',$this->labor);
            }
        });

        $reporte_de_tractores = $reporte_de_tractores->orderBy('id','desc')->paginate(6);

        return view('livewire.asistente.reporte-de-tractores.tabla',compact('reporte_de_tractores'));
    }
}
