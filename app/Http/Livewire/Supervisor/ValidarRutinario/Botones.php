<?php

namespace App\Http\Livewire\Supervisor\ValidarRutinario;

use Livewire\Component;

class Botones extends Component
{
    public function abrir_modal($programacion){
        $this->emitTo('supervisor.validar-rutinario.modal','abrir_modal',$programacion);
    }

    public function render()
    {
        return view('livewire.supervisor.validar-rutinario.botones');
    }
}
