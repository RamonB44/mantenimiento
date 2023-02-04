<?php

namespace App\Http\Livewire\Supervisor\ValidarRutinario;

use Livewire\Component;

class Botones extends Component
{
    public function abrir_modal($modal){
        if($modal == 'rutinarios_no_validados')
        $this->emitTo('supervisor.validar-rutinario.modal','abrir_modal');
    }

    public function render()
    {
        return view('livewire.supervisor.validar-rutinario.botones');
    }
}
