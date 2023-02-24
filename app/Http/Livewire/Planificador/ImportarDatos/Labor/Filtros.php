<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Labor;

use Livewire\Component;

class Filtros extends Component
{
    public $labor;

    public function mount() {
        $this->labor = "";
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.labor.filtros');
    }
}
