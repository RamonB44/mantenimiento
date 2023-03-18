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
    public $implemento_id;
    public $supervisor;
    public $supervisores;
    public $modelos_varios;

    protected $listeners = ['abrirModal'];

    public function mount(){
        $this->open = false;
        $this->fecha = "";
        $this->turno = "";
        $this->programacion_id = 0;
        $this->implemento_id = [];
        $this->modelo_de_implemento_id = 0;
        $this->supervisores = User::whereHas('roles',function($q){
            $q->where('name','supervisor');
        })->where('sede_id',Auth::user()->sede_id)->get();
        $this->supervisor = Auth::user()->id;
        $this->modelos_varios = [1,4];
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

    public function updatedSupervisor(){
        $this->modelo_de_implemento_id = 0;
    }

    public function toggleImplemento($implemento){
        $this->implemento_id ?? [];
        if (($clave = array_search($implemento, $this->implemento_id)) !== false) {
            unset($this->implemento_id[$clave]);
        }else{
            $asignar_uno = !in_array($this->modelo_de_implemento_id,$this->modelos_varios);
            if($asignar_uno){
                $this->implemento_id = [$implemento];
                $this->asignarImplemento(true);
            }else{
                array_push($this->implemento_id,$implemento);
            }
        }
    }

    public function updatedModeloDeImplementoId(){
        $this->implemento_id = [];
    }

    public function asignarImplemento($limpiarImplementos = false){
        $this->emitTo('supervisor.programacion-de-tractores.modal','obtenerImplemento',$this->implemento_id);
        if($limpiarImplementos){
            $this->implemento_id = [];
        }
        $this->open = false;
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
            if(!empty($this->implemento_id)){
                $implementos_asignados = Implemento::whereIn('id',$this->implemento_id)->get();
            }
            if($this->modelo_de_implemento_id > 0){
                $implementos = Implemento::where('supervisor',$this->supervisor)->whereDoesnthave('ImplementoProgramacion',function($q){
                    $q->join('programacion_de_tractors','programacion_de_tractors.id', '=', 'implemento_programacions.programacion_de_tractor_id')->where('programacion_de_tractors.fecha',$this->fecha)->where('programacion_de_tractors.turno',$this->turno)->where('programacion_de_tractors.esta_anulado',0)->whereNotIn('programacion_de_tractors.id',[$this->programacion_id]);
                })->where('modelo_del_implemento_id',$this->modelo_de_implemento_id)->whereNotIn('id',$this->implemento_id)->orderBy('modelo_del_implemento_id')->orderBy('numero')->get();
            }
        }

        return view('livewire.supervisor.programacion-de-tractores.lista-implementos',compact('modelos_de_implemento','implementos','implementos_asignados'));
    }
}
