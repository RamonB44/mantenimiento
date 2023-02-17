<?php

namespace App\Http\Livewire\Planificador\ImportarDatos;

use Livewire\Component;

class Base extends Component
{
    public $tabla;

    public function mount(){
        $this->tabla = "";
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.base');
    }
}
