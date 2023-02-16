<?php

namespace App\Http\Livewire\Planificador\ValidarSolicitudDeArticulo;

use App\Models\DetalleDeSolicitudDePedido;
use App\Models\Implemento;
use App\Models\SolicitudDePedido;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $fecha_de_pedido;
    public $sede_id;
    public $implementos;
    public $implementoid;
    public $monto_disponible;
    public $operario_id;
    public $operario;
    public $estado;

    protected $listeners = ['mostrarPedidos'];

    public function mount($fecha_de_pedido, $sede_id)
    {
        $this->open = false;
        $this->fecha_de_pedido = $fecha_de_pedido;
        $this->sede_id = $sede_id;
        $this->implementos = new Implemento();
        $this->implementoid = 0;
        $this->monto_disponible = 0;
        $this->operario_id = 0;
        $this->operario = "";
        $this->estado = "";
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open','fecha_de_pedido','sede_id');
        }
    }

    public function mostrarPedidos($operario_id,$operario,$estado){
        if($operario_id > 0){
            $this->open = true;
            $this->operario_id = $operario_id;
            $this->operario = $operario;
            $this->estado = $estado;
        }
        $this->implementos = Implemento::whereHas('SolicitudDePedido',function($q){
            $q->where('solicitante',$this->operario_id)->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('estado',$this->estado);
        })->get();
        
    }
    public function validarSolicitudPedido(){
        $solicitud_de_pedido = SolicitudDePedido::where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('implemento_id',$this->implementoid)->first()->id;
        if(DetalleDeSolicitudDePedido::where('solicitud_de_pedido_id',$solicitud_de_pedido)->where('estado','PENDIENTE')->exists()){
            $this->emit('alerta',['center','warning','Hay pedidos pendientes en validar']);
        }else{
            $pedido = SolicitudDePedido::find($solicitud_de_pedido);
            $pedido->estado = 'VALIDADO';
            $pedido->save();
            $this->emit('alerta',['center','success','Validado correctamente']);
        }
    }

    public function render()
    {
        if($this->implementoid > 0){
            $ceco = Implemento::find($this->implementoid)->centro_de_costo_id;
            $monto_asignado = DB::table('detalle_monto_cecos_por_meses')->where('centro_de_costo_id',$ceco)->whereIn('mes',[intval($this->fecha_de_pedido)+1,intval($this->fecha_de_pedido)+2])->sum('monto');
            $monto_usado = DB::table('montos_usado_validar_pedido')->where('fecha_de_pedido',$this->fecha_de_pedido)->where('centro_de_costo_id',$ceco)->first();
           if($monto_usado != NULL){
            $monto_usado = $monto_usado->total;
           }else{
            $monto_usado = 0;
           }
           $this->monto_disponible = $monto_asignado - $monto_usado;
        }
        $this->emitTo('planificador.validar-solicitud-de-articulo.tabla','cambiar_implemento',$this->implementoid);

        return view('livewire.planificador.validar-solicitud-de-articulo.modal');
    }
}
