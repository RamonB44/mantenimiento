<?php

namespace App\Http\Livewire\Planificador\ResumenDePedido;

use App\Models\CentroDeCosto;
use Livewire\Component;

class Base extends Component
{
    public $fecha_de_pedido;
    public $sede_id;
    public $ceco_id;
    public $cecos;

    public function mount($fecha_de_pedido, $sede_id){
        $this->fecha_de_pedido = $fecha_de_pedido;
        $this->sede_id = $sede_id;
        $this->ceco_id = 0;
        $this->cecos = CentroDeCosto::where('sede_id',$sede_id)->get();
    }

    public function render()
    {
        return view('livewire.planificador.resumen-de-pedido.base');
    }
}
