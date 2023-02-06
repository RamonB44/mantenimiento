<?php

namespace App\Http\Livewire\Supervisor\ValidarRutinario;

use App\Models\ProgramacionDeTractor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tabla extends Component
{
    public $validados;

    protected $listeners = ['render'];

    public function mount(){
        $this->validados = true;
    }

    public function abrir_modal($programacion){
        $this->emitTo('supervisor.validar-rutinario.modal','abrir_modal',$programacion);
    }

    public function render()
    {
        if($this->validados){
            $rutinarios = ProgramacionDeTractor::has('Rutinarios')->where('validado_por',Auth::user()->id)->where('esta_anulado',0)->orderBy('id','desc')->paginate(6);
        }else{
            $rutinarios = ProgramacionDeTractor::doesnthave('Rutinarios')->where('validado_por',Auth::user()->id)->where('esta_anulado',0)->orderBy('id','desc')->paginate(6);
        }

        return view('livewire.supervisor.validar-rutinario.tabla',compact('rutinarios'));
    }
}
