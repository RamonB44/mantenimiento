<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Tractor;

use App\Models\ModeloDeTractor;
use Livewire\Component;

class Filtros extends Component
{
    public $open;

    protected $listeners = ['abrirModal'];

    public function mount(){
        $this->open = false;
    }

    public function abrirModal(){
        $this->open = true;
    }

    public function filtrar(){

    }

    public function render()
    {
        $modelo_de_tractors = ModeloDeTractor::all();
        return view('livewire.planificador.importar-datos.tractor.filtros',compact('modelo_de_tractors'));
    }
}
