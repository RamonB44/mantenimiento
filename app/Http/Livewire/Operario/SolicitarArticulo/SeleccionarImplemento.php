<?php

namespace App\Http\Livewire\Operario\SolicitarArticulo;

use App\Models\Implemento;
use App\Models\SolicitudDePedido;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SeleccionarImplemento extends Component
{
    public $implemento_id;
    public $fecha_de_pedido;

    public function mount($fecha_de_pedido){
        $this->implemento_id = 0;
        $this->fecha_de_pedido = $fecha_de_pedido;
    }

    public function updatedImplementoId(){
        $this->emit('cambiarImplemento',$this->implemento_id);
    }

    public function cerrarPedido(){
        $solicitud_de_pedido = SolicitudDePedido::where('implemento_id',$this->implemento_id)->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('solicitante',Auth::user()->id)->first();
        $solicitud_de_pedido->estado = "CERRADO";
        $solicitud_de_pedido->save();
        $this->emit('alerta',['center','success','Solicitud Cerrada']);
        $this->reset('implemento_id');
        $this->emit('cambiarImplemento',$this->implemento_id);
    }

    public function render()
    {
        $implementos = Implemento::whereDoesntHave('SolicitudDePedido',function($q){
            $q->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('estado','VALIDADO')->orWhere('estado','CERRADO');
        })->where('responsable',Auth::user()->id)->get();

        return view('livewire.operario.solicitar-articulo.seleccionar-implemento',compact('implementos'));
    }
}
