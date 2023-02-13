<?php

namespace App\Http\Livewire\Operador;

use Livewire\Component;

class SolicitarArticuloNuevo extends Component
{
    public $fecha_de_pedido;
    public $implemento_id;

    public function mount($implemento_id,$fecha_de_pedido){
        $this->fecha_de_pedido = $fecha_de_pedido;
        $this->implemento_id = $implemento_id;
    }

    public function render()
    {
        return view('livewire.operador.solicitar-articulo-nuevo');
    }
}
