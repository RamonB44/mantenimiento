<?php

namespace App\Http\Livewire\Jefe\ProgramacionCultivo;

use App\Models\Cultivo;
use App\Models\Fundo;
use App\Models\ProgramacionDeTractor;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ModalTabla extends Component
{
    public $open;
    public $sede_id;
    public $fecha;
    public $turno;
    public $supervisor;
    public $cultivo_id;
    public $fundo_id;

    protected $listeners = ['abrirModal'];

    public function mount(){
        $this->open = false;
        $this->sede_id = 0;
        $this->fecha = date('Y-m-d');
        $this->turno = "MAÑANA";
        $this->supervisor = 0;
        $this->cultivo_id = 0;
        $this->fundo_id = 0;
    }

    public function abrirModal($sede_id,$fecha,$turno,$supervisor,$cultivo_fundo_id){
        $this->sede_id = $sede_id;
        $this->open = true;
        $this->fecha = $fecha;
        $this->turno = $turno;
        $this->supervisor = $supervisor;
        $cultivo_fundo = explode(",",$cultivo_fundo_id);
        $this->cultivo_id = $cultivo_fundo[0];
        $this->fundo_id = $cultivo_fundo[1];
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->sede_id = 0;
            $this->supervisor = 0;
            $this->cultivo_id = 0;
            $this->fundo_id = 0;
        }
    }

    public function render()
    {
        if($this->sede_id > 0 && $this->fecha != "" && $this->turno != "" && $this->cultivo_id > 0 && $this->fundo_id > 0){
            $programacion_de_tractores = ProgramacionDeTractor::join('tractors','tractors.id','programacion_de_tractors.tractor_id')->where('tractors.sede_id',$this->sede_id)->where('programacion_de_tractors.fecha',$this->fecha)->where('programacion_de_tractors.turno',$this->turno)->where('tractors.cultivo_id',$this->cultivo_id)->where(DB::raw('COALESCE(tractors.fundo_id,0)'),$this->fundo_id);
            if($this->supervisor > 0){
                $programacion_de_tractores = $programacion_de_tractores->where('tractors.supervisor',$this->supervisor);
            }
            $programacion_de_tractores = $programacion_de_tractores->get();
        }else{
            $programacion_de_tractores = [];
        }

        $cultivo = $this->cultivo_id > 0 ? Cultivo::find($this->cultivo_id)->cultivo : '';
        $fundo = $this->fundo_id > 0 ? Fundo::find($this->fundo_id)->fundo : '';

        return view('livewire.jefe.programacion-cultivo.modal-tabla',compact('cultivo','fundo','programacion_de_tractores'));
    }
}
