<?php

namespace App\Http\Livewire\Operador\SolicitarArticulo;

use App\Models\DetalleDeSolicitudDePedido;
use App\Models\SolicitudDePedido;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $implemento_id;

    protected $listeners = ['cambiar_implemento'];

    public function mount(){
        $this->implemento_id = 0;
    }

    public function cambiar_implemento($id){
        $this->implemento_id = $id;
    }

    public function render()
    {
        if($this->implemento_id > 0){
            $solicitud_de_pedido = SolicitudDePedido::where('solicitante',Auth::user()->id)->where('implemento_id',$this->implemento_id)->first()->id;
            $detalle_solicitud_de_pedidos = DetalleDeSolicitudDePedido::where('solicitud_de_pedido_id',$this->solicitud_de_pedido);
        }else{
            $detalle_solicitud_de_pedidos = [];
        }
        return view('livewire.operador.solicitar-articulo.tabla',compact('detalle_solicitud_de_pedidos'));
    }
}
