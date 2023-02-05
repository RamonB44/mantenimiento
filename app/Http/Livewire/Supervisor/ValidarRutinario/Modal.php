<?php

namespace App\Http\Livewire\Supervisor\ValidarRutinario;

use App\Models\ProgramacionDeTractor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $fecha;
    public $rutinario;
    public $accion;

    protected $listeners = ['abrir_modal'];

    public function mount(){
        $this->open = false;
        $this->fecha = date('Y-m-d');
        $this->rutinario = 0;
    }

    public function abrir_modal($programacion){
        if($programacion > 0){
            $this->accion = "crear";
        }else{
            $this->accion = "editar";
            $this->reset('rutinario');
        }
        $this->open = true;
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->emitTo('supervisor.validar-rutinario.tabla','render');
            $this->reset('rutinario');
        }
    }

    public function updatedRutinario(){
        $this->emitTo('supervisor.validar-rutinario.tareas','mostrarTareas',$this->rutinario);
        $this->emit('checkout_all');
    }

    public function render()
    {
        $rutinarios = ProgramacionDeTractor::doesnthave('Rutinarios')->where('fecha',$this->fecha)->where('validado_por',Auth::user()->id)->where('esta_anulado',0)->get();

        return view('livewire.supervisor.validar-rutinario.modal',compact('rutinarios'));
    }
}
