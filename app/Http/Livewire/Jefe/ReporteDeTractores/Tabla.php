<?php

namespace App\Http\Livewire\Jefe\ReporteDeTractores;

use App\Exports\TractorReportsExport;
use App\Models\ProgramacionDeTractor;
use App\Models\ReporteDeTractor;
use App\Models\Sede;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class Tabla extends Component
{
    use WithPagination;

    public $sede_id;
    public $fecha;
    public $turno;
    public $search;

    protected $listeners = ['obtenerSede','filtrar','pdf','excel'];

    public function mount($sede_id){
        $this->sede_id = $sede_id;
        $this->fecha = Carbon::yesterday()->isoFormat('Y-MM-DD');
        $this->turno = "MAÑANA";
    }

    public function obtenerSede($sede_id){
        $this->resetExcept('fecha','turno');
        $this->sede_id = $sede_id;
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
        $reporte_de_tractores = ReporteDeTractor::where('sede_id',$this->sede_id)->whereHas('ProgramacionDeTractor',function($q){ $q->where('fecha',$this->fecha)->where('turno',$this->turno); })->get();

        if($this->search != ""){
            $reporte_de_tractores = $reporte_de_tractores->filter(function($reporte_de_tractores){
                $hay_implementos = false;
                foreach($reporte_de_tractores->ProgramacionDeTractor->Implementos as $implemento){
                    $hay_implementos = false !== stripos($implemento->Implemento->ModeloDelImplemento,$this->search);
                    if($hay_implementos){
                        break;
                    }
                }
                if(is_null($reporte_de_tractores->ProgramacionDeTractor->Tractor)){
                    $hay_tractor = false !== stripos('AUTOPROPULSADO',$this->search);
                }else{
                    $hay_tractor = false !== stripos($reporte_de_tractores->ProgramacionDeTractor->Tractor->ModeloDeTractor->modelo_de_tractor,$this->search);
                }
                return false !== stripos($reporte_de_tractores->ProgramacionDeTractor->Tractorista->name,$this->search) || $hay_tractor || $hay_implementos || false !== stripos($reporte_de_tractores->ProgramacionDeTractor->Lote->Fundo->fundo,$this->search) || false !== stripos($reporte_de_tractores->ProgramacionDeTractor->Lote->Cultivo->cultivo,$this->search) || false !== stripos($reporte_de_tractores->ProgramacionDeTractor->Lote->lote,$this->search) || false !== stripos($reporte_de_tractores->ProgramacionDeTractor->Labor->labor,$this->search) || false !== stripos($reporte_de_tractores->ProgramacionDeTractor->Solicitante->name,$this->search);
            });
        }

        $total_de_programaciones = ProgramacionDeTractor::where('sede_id',$this->sede_id)->where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0)->whereNotNull('tractor_id')->count();

        $reporte_de_tractores = $reporte_de_tractores->sortBy(function ($reporte_de_tractores,$key){
            if(isset($reporte_de_tractores->ProgramacionDeTractor->Tractor)){
                return $reporte_de_tractores->ProgramacionDeTractor->Tractor->numero;
            }
        });


        return view('livewire.jefe.reporte-de-tractores.tabla',compact('reporte_de_tractores','total_de_programaciones'));
    }
}
