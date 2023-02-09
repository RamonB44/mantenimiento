<?php

namespace App\Http\Livewire\Operador;

use App\Models\FechaDePedido;
use Livewire\Component;

class SolicitarArticulos extends Component
{
    public $existe_pedido;

    public function mount(){
        $this->existe_pedido = FechaDePedido::where('estado','ABIERTO')->exists();
    }

    public function render()
    {
        return view('livewire.operador.solicitar-articulos');
    }
}
