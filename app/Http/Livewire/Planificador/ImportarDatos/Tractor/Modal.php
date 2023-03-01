<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Tractor;

use App\Models\ModeloDeTractor;
use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $sede_id;
    public $modelo_de_tractor_id;
    public $numero;

    public function mount() {
        $this->open = false;
        $this->sede_id = 0;
        $this->modelo_de_tractor_id = 0;
        $this->numero = 0;
    }

    public function render()
    {
        $modelos = ModeloDeTractor::all();

        return view('livewire.planificador.importar-datos.tractor.modal',compact('modelos'));
    }
}
