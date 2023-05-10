<?php

namespace App\Http\Livewire\Planificador\Stock;

use Livewire\Component;

class ImportarStock extends Component
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
        return view('livewire.planificador.stock.importar-stock');
    }
}
