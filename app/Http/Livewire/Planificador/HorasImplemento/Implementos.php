<?php

namespace App\Http\Livewire\Planificador\HorasImplemento;

use Livewire\Component;

class Implementos extends Component
{
    public $sede_id;

    protected $listeners = ['obtenerSede'];

    public function mount($sede_id){
        $this->sede_id = $sede_id;
    }

    public function obtenerSede($sede_id) {
        $this->sede_id = $sede_id;
    }

    public function render()
    {
        return view('livewire.planificador.horas-implemento.implementos');
    }
}
