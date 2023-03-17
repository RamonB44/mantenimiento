<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\Implemento;
use App\Models\ModeloDelImplemento;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaImplementos extends Component
{

    public $open;
    public $fecha;
    public $turno;
    public $programacion_id;
    public $modelo_de_implemento_id;
    public $implemento;
    public $supervisor;
    public $supervisores;

    protected $listeners = ['abrirModal'];

    public function mount(){
        $this->open = false;
        $this->fecha = "";
        $this->turno = "";
        $this->programacion_id = 0;
        $this->implemento = [];
        $this->modelo_de_implemento_id = 0;
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
            $this->modelo_de_implemento_id = 0;
        }
    }

    public function updatedSupervisor(){
        $this->modelo_de_implemento_id = 0;
    }

    public function updatedImplemento($implemento){
        //$this->emitTo('supervisor.programacion-de-tractores.modal','obtenerImplemento',$this->implemento);
        //$this->supervisor = Auth::user()->id;
        //$this->fecha = "";
        //$this->turno = "";
        //$this->open = false;
        if(!in_array($this->implemento,$implemento)){
            array_push($implemento,$this->implemento);
        }
    }

    public function render()
    {
        $modelos_de_implemento = [];
        $implementos = [];
        $implementos_asignados = [];
        if($this->fecha != "" && $this->turno != ""){
            $modelos_de_implemento = ModeloDelImplemento::whereHas('Implemento',function($q){
                $q->where('supervisor',$this->supervisor);
            })->orderBy('modelo_de_implemento')->get();
            if(!empty($this->implemento)){
                $implementos_asignados = Implemento::whereIn('id',$this->implemento)->get();
            }
            if($this->modelo_de_implemento_id > 0){
                $implementos = Implemento::where('supervisor',$this->supervisor)->whereDoesnthave('ImplementoProgramacion',function($q){
                    $q->join('programacion_de_tractors','programacion_de_tractors.id', '=', 'implemento_programacions.programacion_de_tractor_id')->where('programacion_de_tractors.fecha',$this->fecha)->where('programacion_de_tractors.turno',$this->turno)->where('programacion_de_tractors.esta_anulado',0)->whereNotIn('programacion_de_tractors.id',[$this->programacion_id]);
                })->where('modelo_del_implemento_id',$this->modelo_de_implemento_id)->orderBy('modelo_del_implemento_id')->orderBy('numero')->get();
            }
        }

        return view('livewire.supervisor.programacion-de-tractores.lista-implementos',compact('modelos_de_implemento','implementos','implementos_asignados'));
    }
}
