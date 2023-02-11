<?php

namespace App\Http\Livewire\Operador;

use App\Models\FechaDePedido;
use Carbon\Carbon;
use Livewire\Component;

class SolicitarArticulos extends Component
{
    public $implemento_id;
    public $existe_pedido;

    protected $listeners = ['cambiar_implemento'];

    public function mount(){
        $this->implemento_id = 0;
        $this->existe_pedido = FechaDePedido::whereDate('fecha_de_apertura','<=',Carbon::today())->whereDate('fecha_de_cierre','>=',Carbon::today())->exists();
    }

    public function cambiar_implemento($id){
        $this->implemento_id = $id;
    }

    public function render()
    {
        return view('livewire.operador.solicitar-articulos');
    }
}
