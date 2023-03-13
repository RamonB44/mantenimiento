<?php

namespace App\Http\Livewire\Planificador\IngresoArticulos;

use App\Models\FechaDePedido;
use Livewire\Component;

class Importar extends Component
{
    public $open;
    public $sede_id;
    public $pedidos;

    protected $listeners = ['abrirModal','obtenerSede'];

    public function mount($sede_id){
        $this->open = false;
        $this->sede_id = $sede_id;
        $this->pedidos = FechaDePedido::latest()->get();
    }

    public function abrirModal(){
        $this->open = true;
    }

    public function obtenerSede($sede_id){
        $this->sede_id = $sede_id;
    }

    public function render()
    {
        return view('livewire.planificador.ingreso-articulos.importar');
    }
}
