<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\FechaPedido;

use App\Models\FechaDePedido;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $fecha_pedido_id;

    protected $listeners = ['render','filtrar'];

    public function mount()
    {
        $this->fecha_pedido_id = 0;
    }

    public function seleccionar($id){
        $this->fecha_pedido_id = $id;
        $this->emitTo('planificador.importar-datos.fecha-pedido.botones','obtenerFechaPedido',$id);
    }

    public function render()
    {
        $fechas_de_pedido = FechaDePedido::orderBy('fecha_de_pedido','asc')->paginate(6);

        return view('livewire.planificador.importar-datos.fecha-pedido.tabla', compact('fechas_de_pedido'));
    }
}
