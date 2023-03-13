<?php

namespace App\Http\Livewire\Planificador\IngresoArticulos;

use Livewire\Component;

class Importar extends Component
{
    public $open;

    protected $listeners = ['abrirModal'];

    public function mount(){
        $this->open = false;
    }

    public function abrirModal(){
        $this->open = true;
    }

    public function render()
    {
        return view('livewire.planificador.ingreso-articulos.importar');
    }
}
