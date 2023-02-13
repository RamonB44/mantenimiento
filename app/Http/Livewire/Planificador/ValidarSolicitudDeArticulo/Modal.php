<?php

namespace App\Http\Livewire\Planificador\ValidarSolicitudDeArticulo;

use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $fecha_de_pedido;
    public $sede_id;

    public function mount($fecha_de_pedido, $sede_id)
    {
        $this->open = false;
        $this->fecha_de_pedido = $fecha_de_pedido;
        $this->sede_id = $sede_id;
    }

    public function render()
    {
        return view('livewire.planificador.validar-solicitud-de-articulo.modal');
    }
}
