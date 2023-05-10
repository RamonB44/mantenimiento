<?php

namespace App\Http\Livewire\Jefe\ProgramacionCultivo;

use App\Models\Cultivo;
use App\Models\Fundo;
use App\Models\ProgramacionDeTractor;
use App\Models\Tractor;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ModalTabla extends Component
{
    public $open;
    public $ver_programados;
    public $sede_id;
    public $fecha;
    public $turno;
    public $supervisor;
    public $cultivo_id;
    public $fundo_id;
    public $cantidad_tractores;
    public $cantidad_programados;

    protected $listeners = ['abrirModal'];

    public function mount(){
        $this->open = false;
        $this->ver_programados = true;
        $this->sede_id = 0;
        $this->fecha = date('Y-m-d');
        $this->turno = "MAÑANA";
        $this->supervisor = 0;
        $this->cultivo_id = 0;
        $this->fundo_id = 0;
        $this->cantidad_tractores = 0;
        $this->cantidad_programados = 0;
    }

    public function abrirModal($sede_id,$fecha,$turno,$supervisor,$cultivo_fundo_id,$cantidad_tractores,$cantidad_programados){
        $this->sede_id = $sede_id;
        $this->fecha = $fecha;
        $this->turno = $turno;
        $this->supervisor = $supervisor;
        $cultivo_fundo = explode(",",$cultivo_fundo_id);
        $this->cultivo_id = $cultivo_fundo[0];
        $this->fundo_id = $cultivo_fundo[1];
        $this->cantidad_tractores = $cantidad_tractores;
        $this->cantidad_programados = $cantidad_programados;
        $this->ver_programados = $cantidad_programados > 0;
        $this->open = true;
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->sede_id = 0;
            $this->supervisor = 0;
            $this->cultivo_id = 0;
            $this->fundo_id = 0;
            $this->ver_programados = true;
        }
    }

    public function toggleVerProgramados(){
        $this->ver_programados = !$this->ver_programados;
    }

    public function render()
    {
        $programacion_de_tractores = [];
        $tractores_no_programados = [];
        if($this->ver_programados){
            if($this->sede_id > 0 && $this->fecha != "" && $this->turno != "" && $this->cultivo_id > 0){
                $programacion_de_tractores = ProgramacionDeTractor::join('tractors','tractors.id','programacion_de_tractors.tractor_id')->where('tractors.sede_id',$this->sede_id)->where('programacion_de_tractors.fecha',$this->fecha)->where('programacion_de_tractors.turno',$this->turno)->where('tractors.cultivo_id',$this->cultivo_id)->where(DB::raw('COALESCE(tractors.fundo_id,0)'),$this->fundo_id)->where('programacion_de_tractors.esta_anulado',0);
                if($this->supervisor > 0){
                    $programacion_de_tractores = $programacion_de_tractores->where('tractors.supervisor',$this->supervisor);
                }
                $programacion_de_tractores = $programacion_de_tractores->orderBy('tractors.numero')->get();
            }
        }else{
            $tractores_no_programados = Tractor::join('modelo_de_tractors','modelo_de_tractors.id','tractors.modelo_de_tractor_id')
                ->select('modelo_de_tractors.modelo_de_tractor','tractors.numero')
                ->whereNotExists(function ($query) {
                    $query->from('programacion_de_tractors')
                        ->select('*')
                        ->where('programacion_de_tractors.tractor_id',DB::raw('tractors.id'))
                        ->where('programacion_de_tractors.fecha',$this->fecha)
                        ->where('turno',$this->turno)
                        ->where('esta_anulado',0);
            })->where('cultivo_id',$this->cultivo_id)
            ->where(DB::raw('COALESCE(fundo_id,0)'),$this->fundo_id);
            if($this->supervisor > 0){
                $tractores_no_programados = $tractores_no_programados->where('supervisor',$this->supervisor);
            }

            $tractores_no_programados = $tractores_no_programados->where('sede_id',$this->sede_id)->orderBy('numero')->get();
        }


        $cultivo = $this->cultivo_id > 0 ? Cultivo::find($this->cultivo_id)->cultivo : '';
        $fundo = $this->fundo_id > 0 ? Fundo::find($this->fundo_id)->fundo : '';

        return view('livewire.jefe.programacion-cultivo.modal-tabla',compact('cultivo','fundo','programacion_de_tractores','tractores_no_programados'));
    }
}
