<?php

namespace App\Http\Livewire\Operador\SolicitarArticulo;

use Livewire\Component;

class Botones extends Component
{

    public $implemento_id;

    protected $listeners = ['cambiar_implemento'];

    public function mount(){
        $this->implemento_id = 0;
    }

    public function cambiar_implemento($id){
        $this->implemento_id = $id;
    }

    public function abrir_modal($accion){
        $this->emitTo('operador.solicitar-articulo.modal','abrir_modal', $accion);
    }
    
    public function render()
    {
        return view('livewire.operador.solicitar-articulo.botones');
    }
}
