<?php

namespace App\Http\Livewire\Operador\SolicitarArticulo;

use App\Models\DetalleDeSolicitudDePedido;
use App\Models\SolicitudDePedido;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $implemento_id;

    protected $listeners = ['cambiar_implemento','render'];

    public function mount($implemento_id){
        $this->implemento_id = $implemento_id;
    }

    public function cambiar_implemento($id){
        $this->implemento_id = $id;
    }

    public function render()
    {
        try{
            if($this->implemento_id > 0){
                $solicitud_de_pedido = SolicitudDePedido::where('solicitante',Auth::user()->id)->where('implemento_id',$this->implemento_id)->first()->id;
                $detalle_solicitud_de_pedidos = DetalleDeSolicitudDePedido::where('solicitud_de_pedido_id',2)->get();
            }else{
                $detalle_solicitud_de_pedidos = [];
            }
        }catch(Exception $e){
            $detalle_solicitud_de_pedidos = [];
        }
        return view('livewire.operador.solicitar-articulo.tabla',compact('detalle_solicitud_de_pedidos'));
    }
}
