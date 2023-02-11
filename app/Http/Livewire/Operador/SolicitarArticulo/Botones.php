<?php

namespace App\Http\Livewire\Operador\SolicitarArticulo;

use Livewire\Component;

class Botones extends Component
{
    public function abrir_modal($accion){
        $this->emitTo('operador.solicitar-articulo.modal','abrir_modal', $accion);
    }
    
    public function render()
    {
        return view('livewire.operador.solicitar-articulo.botones');
    }
}
