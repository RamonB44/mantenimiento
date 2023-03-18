<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\ModeloDeTractor;
use App\Models\Tractor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaTractores extends Component
{
    public $open;
    public $fecha;
    public $turno;
    public $programacion_id;
    public $tractor;
    public $supervisor;
    public $supervisores;

    protected $listeners = ['abrirModal'];

    public function mount(){
        $this->open = false;
        $this->fecha = "";
        $this->turno = "";
        $this->programacion_id = 0;
        $this->tractor = 0;
        $this->supervisores = User::whereHas('roles',function($q){
            $q->where('name','supervisor');
        })->where('sede_id',Auth::user()->sede_id)->get();
        $this->supervisor = Auth::user()->id;
    }

    public function abrirModal($fecha,$turno,$programacion_id){
        $this->fecha = $fecha;
        $this->turno = $turno;
        $this->programacion_id = $programacion_id;
        $this->open = true;
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->supervisor = Auth::user()->id;
            $this->fecha = "";
            $this->turno = "";
        }
    }


    public function updatedTractor(){
        $this->emitTo('supervisor.programacion-de-tractores.modal','obtenerTractor',$this->tractor);
        $this->supervisor = Auth::user()->id;
        $this->fecha = "";
        $this->turno = "";
        $this->open = false;
    }

    public function render()
    {
        if($this->fecha == "" || $this->turno == ""){
            $tractores = [];
            return view('livewire.supervisor.programacion-de-tractores.lista-tractores',compact('tractores'));
        }

        $tractores = Tractor::where('supervisor',$this->supervisor)->whereDoesnthave('ProgramacionDeTractor',function($q){
            $q->where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0)->whereNotIn('id',[$this->programacion_id]);
        })->orderBy(
            ModeloDeTractor::select('modelo_de_tractor')
                ->whereColumn('tractors.modelo_de_tractor_id', 'modelo_de_tractors.id'),
            'asc'
        )->orderBy('numero','asc')->get();

        return view('livewire.supervisor.programacion-de-tractores.lista-tractores',compact('tractores'));
    }
}
