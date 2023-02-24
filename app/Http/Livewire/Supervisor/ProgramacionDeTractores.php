<?php

namespace App\Http\Livewire\Supervisor;

use Livewire\Component;

class ProgramacionDeTractores extends Component
{
    public $programacion_id = 0;

    protected $listeners = ['obtenerProgramacion'];

    public function obtenerProgramacion($id){
        $this->programacion_id  = $id;
    }

    public function render()
    {
        return view('livewire.supervisor.programacion-de-tractores');
    }
}
