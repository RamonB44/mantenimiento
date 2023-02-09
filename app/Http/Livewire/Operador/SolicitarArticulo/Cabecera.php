<?php

namespace App\Http\Livewire\Operador\SolicitarArticulo;

use App\Models\FechaDePedido;
use Livewire\Component;
use Carbon\Carbon;

class Cabecera extends Component
{
    public $fecha_pedido_id;
    public $fecha_pedido;
    public $fecha_de_apertura;
    public $fecha_de_cierre;
    public $fecha_de_llegada;
    public $monto_asignado;
    public $monto_usado;
    
    public function mount(){
        Carbon::setLocale(LC_ALL, 'es_ES');
        if(FechaDePedido::where('estado','ABIERTO')->exists()){
            $pedido = FechaDePedido::where('estado','ABIERTO')->first();
            $this->fecha_pedido_id = $pedido->id;
            $this->fecha_pedido = Carbon::parse($pedido->fecha_de_pedido)->isoFormat('MMMM');
            $this->fecha_de_apertura = $pedido->fecha_de_apertura;
            $this->fecha_de_cierre = Carbon::parse($pedido->fecha_de_cierre)->diffForHumans();
            $this->fecha_de_llegada = $pedido->fecha_de_llegada;
        }else{
            $this->fecha_pedido = "";
        }
    }

    public function render()
    {
        
        return view('livewire.operador.solicitar-articulo.cabecera');
    }
}
