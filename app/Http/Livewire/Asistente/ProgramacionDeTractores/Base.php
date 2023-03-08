<?php

namespace App\Http\Livewire\Asistente\ProgramacionDeTractores;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Base extends Component
{
    public $supervisor_id;
    public $fecha;

    public function mount(){
        $this->fecha = date('Y-m-d');
        $this->supervisor_id = Auth::user()->id;
    }

    public function updatedFecha(){
        $this->emit('obtenerFecha',$this->fecha);
    }

    public function render()
    {
        return view('livewire.asistente.programacion-de-tractores.base');
    }
}
