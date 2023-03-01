<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Labor;

use Livewire\Component;

class Filtros extends Component
{
    public $open;
    public $labor;

    protected $listeners = ['abrirModal'];

    public function mount() {
        $this->open = false;
        $this->labor = "";
    }

    public function abrirModal() {
        $this->open = true;
    }

    public function filtrar() {
        $this->emitTo('planificador.importar-datos.labor.tabla','filtrar',$this->labor);
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.labor.filtros');
    }
}
