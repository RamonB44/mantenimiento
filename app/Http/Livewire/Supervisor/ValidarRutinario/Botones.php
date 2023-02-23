<?php

namespace App\Http\Livewire\Supervisor\ValidarRutinario;

use Livewire\Component;

class Botones extends Component
{
    public function abrirModal($programacion){
        $this->emitTo('supervisor.validar-rutinario.modal','abrirModal',$programacion);
    }

    public function render()
    {
        return view('livewire.supervisor.validar-rutinario.botones');
    }
}
