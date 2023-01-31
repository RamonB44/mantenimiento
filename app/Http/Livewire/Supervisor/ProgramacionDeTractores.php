<?php

namespace App\Http\Livewire\Supervisor;

use Livewire\Component;

class ProgramacionDeTractores extends Component
{
    public $programacion_id = 0;

    protected $listeners = ['obtener_programacion'];

    public function obtener_programacion($id){
        $this->programacion_id  = $id;
    }

    public function render()
    {
        return view('livewire.supervisor.programacion-de-tractores');
    }
}
