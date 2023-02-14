<?php

namespace App\Http\Livewire\Planificador\ValidarSolicitudDeArticulo;

use App\Models\Implemento;
use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $fecha_de_pedido;
    public $sede_id;
    public $implementos;
    public $implemento_id;
    public $monto_asignado;
    public $operario_id;
    public $operario;
    public $pedidos_pendientes;

    protected $listeners = ['mostrar_pedidos'];

    public function mount($fecha_de_pedido, $sede_id)
    {
        $this->open = false;
        $this->fecha_de_pedido = $fecha_de_pedido;
        $this->sede_id = $sede_id;
        $this->implementos = new Implemento();
        $this->implemento_id = 0;
        $this->monto_asignado = 0;
        $this->operario_id = 0;
        $this->operario = "";
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open','fecha_de_pedido','sede_id');
        }
    }

    public function udpatedImplementoId(){
        
    }

    public function mostrar_pedidos($operario_id,$operario,$estado){
        $this->open = true;
        $this->operario_id = $operario_id;
        $this->operario = $operario;
        if($estado == 'CERRADO'){
            $this->implementos = Implemento::whereHas('SolicitudDePedido',function($q){
                $q->where('solicitante',$this->operario_id)->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('estado','CERRADO');
            })->get();
        }else if($estado == 'VALIDADO'){
            $this->implementos = Implemento::whereHas('SolicitudDePedido',function($q){
                $q->where('solicitante',$this->operario_id)->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('estado','VALIDADO');
            })->get();
        }else{
            $this->reset('implementos');
        }
    }

    public function render()
    {
        return view('livewire.planificador.validar-solicitud-de-articulo.modal');
    }
}
