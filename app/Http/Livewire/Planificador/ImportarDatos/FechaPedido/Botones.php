<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\FechaPedido;

use Livewire\Component;

class Botones extends Component
{
    public $fecha_pedido_id = 0;
    public $boton_activo = false;

    protected $listeners = ['obtenerFechaPedido'];

    public function obtenerFechaPedido($id){
        $this->fecha_pedido_id = $id;
        $this->boton_activo = $id > 0;
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.fecha-pedido.botones');
    }
}
