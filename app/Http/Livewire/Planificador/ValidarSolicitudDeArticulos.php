<?php

namespace App\Http\Livewire\Planificador;

use App\Models\FechaDePedido;
use App\Models\Sede;
use Carbon\Carbon;
use Livewire\Component;

class ValidarSolicitudDeArticulos extends Component
{
    public $fecha_de_pedido;
    public $existe_pedido;
    public $mes_de_pedido;

    public $sedes;
    public $sede_id;

    public function mount(){
        Carbon::setLocale(LC_ALL, 'es_ES');
        $this->existe_pedido =$this->existe_pedido = FechaDePedido::whereDate('fecha_de_apertura','<=',Carbon::today())->whereDate('fecha_de_pedido','>=',Carbon::today())->exists();
        if($this->existe_pedido){
            $fecha_de_pedido = FechaDePedido::whereDate('fecha_de_apertura','<=',Carbon::today())->whereDate('fecha_de_pedido','>=',Carbon::today())->first();
            $this->fecha_de_pedido = $fecha_de_pedido->id;
            $this->mes_de_pedido = Carbon::parse($fecha_de_pedido->fecha_de_pedido)->isoFormat('MMMM');
            $this->sedes = Sede::all();
            $this->sede_id = 0;
        }
    }

    public function updatedSedeId(){
        $this->emit('cambiar_sede',$this->sede_id);
    }

    public function render()
    {
        return view('livewire.planificador.validar-solicitud-de-articulos');
    }
}
