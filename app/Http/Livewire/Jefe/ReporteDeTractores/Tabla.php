<?php

namespace App\Http\Livewire\Jefe\ReporteDeTractores;

use App\Exports\TractorReportsExport;
use App\Models\ReporteDeTractor;
use App\Models\Sede;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Tabla extends Component
{
    use WithPagination;

    public $sede_id;
    public $fecha;
    public $turno;
    public $fundo;
    public $lote;
    public $tractorista;
    public $tractor;
    public $implemento;
    public $labor;

    protected $listeners = ['obtenerSede','filtrar','pdf','excel'];

    public function mount($sede_id){
        $this->sede_id = $sede_id;
        $this->fecha = date('Y-m-d');
        $this->turno = "";
        $this->fundo = 0;
        $this->lote = 0;
        $this->tractorista = 0;
        $this->tractor = 0;
        $this->implemento = 0;
        $this->labor = 0;
    }

    public function obtenerSede($sede_id){
        $this->resetExcept('fecha');
        $this->sede_id = $sede_id;
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

    public function excel(){
        if($this->fecha == ""){
            $this->emit('alerta',['center','warning','Ingrese la fecha']);
        }else{
            $titulo = 'Reporte de horas del '.date_format(date_create($this->fecha),'d-m-Y').' - '.Sede::find($this->sede_id)->sede;
            return Excel::download(new TractorReportsExport($this->fecha,$this->sede_id),$titulo.'.xlsx');
        }
    }

    public function render()
    {
        $reporte_de_tractores = ReporteDeTractor::where('sede_id',$this->sede_id)->where('esta_anulado',0);


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

        $reporte_de_tractores = $reporte_de_tractores->latest()->paginate(6);

        return view('livewire.jefe.reporte-de-tractores.tabla',compact('reporte_de_tractores'));
    }
}
