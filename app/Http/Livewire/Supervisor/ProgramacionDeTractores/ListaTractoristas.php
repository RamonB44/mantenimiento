<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\ProgramacionDeTractor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaTractoristas extends Component
{
    public $open;
    public $fecha;
    public $turno;
    public $existe_programacion;
    public $programacion_id;
    public $tractorista;
    public $supervisor;
    public $supervisores;

    protected $listeners = ['abrirModal'];

    public function mount(){
        $this->open = false;
        $this->fecha = "";
        $this->turno = "";
        $this->existe_programacion = false;
        $this->programacion_id = 0;
        $this->tractorista = 0;
        $this->supervisores = User::whereHas('roles',function($q){ $q->where('name','supervisor'); })->where('sede_id',Auth::user()->sede_id)->get();
        $this->supervisor = Auth::user()->id;
    }

    public function abrirModal($fecha,$turno,$existe_programacion,$programacion_id){
        $this->fecha = $fecha;
        $this->turno = $turno;
        $this->existe_programacion = $existe_programacion;
        $this->programacion_id = $programacion_id;
        $this->open = true;
    }

    public function getTractoristaProperty(){
        return User::find($this->tractorista);
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->supervisor = Auth::user()->id;
            $this->fecha = "";
            $this->turno = "";
        }
    }

    public function updatedTractorista(){
        $this->emitTo('supervisor.programacion-de-tractores.modal','obtenerTractorista',$this->tractorista);
        $this->supervisor = Auth::user()->id;
        $this->fecha = "";
        $this->turno = "";
        $this->open = false;
    }

    public function render()
    {
        if($this->fecha == "" || $this->turno == ""){
            $tractoristas = [];
            return view('livewire.supervisor.programacion-de-tractores.lista-tractoristas',compact('tractoristas'));
        }

        if($this->existe_programacion){
            $tractoristas = User::doesnthave('roles')->where('supervisor',$this->supervisor)->whereDoesnthave('ProgramacionDeTractor',function($q){
                $q->where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0)->whereNotIn('id',[$this->programacion_id]);
            })->where('is_active',true)->orderBy('name','asc')->get();
        }else{
            $tractoristas = User::doesnthave('roles')->where('supervisor',$this->supervisor)->where('is_active',true)->orderBy('name','asc')->get();
        }


        return view('livewire.supervisor.programacion-de-tractores.lista-tractoristas',compact('tractoristas'));
    }
}
