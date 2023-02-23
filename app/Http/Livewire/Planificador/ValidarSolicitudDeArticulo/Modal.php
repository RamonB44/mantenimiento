<?php

namespace App\Http\Livewire\Planificador\ValidarSolicitudDeArticulo;

use App\Models\SolicitudDeNuevoArticulo;
use App\Models\SolicitudDePedido;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $fecha_de_pedido;
    public $sede_id;
    public $solicitudes;
    public $solicitud_id;
    public $monto_disponible;
    public $operario_id;
    public $operario;
    public $estado;
    public $cantidad_materiales_nuevos;

    protected $listeners = ['mostrarPedidos','obtenerDatos'];

    public function mount($fecha_de_pedido, $sede_id)
    {
        $this->open = false;
        $this->fecha_de_pedido = $fecha_de_pedido;
        $this->sede_id = $sede_id;
        $this->solicitudes = new SolicitudDePedido();
        $this->solicitud_id = 0;
        $this->monto_disponible = 0;
        $this->operario_id = 0;
        $this->operario = "";
        $this->estado = "";
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->emitTo('planificador.validar-solicitud-de-articulo.operarios','cambiarSede',$this->sede_id);
            $this->resetExcept('open','fecha_de_pedido','sede_id');
        }
    }

    public function updatedSolicitudId(){
        $this->obtenerDatos();
    }

    public function obtenerDatos(){
        if($this->solicitud_id > 0){
            $this->emit('cambiarSolicitud',$this->solicitud_id);
            $ceco = SolicitudDePedido::find($this->solicitud_id)->Implemento->centro_de_costo_id;
            $monto_asignado = DB::table('detalle_monto_cecos_por_meses')->where('centro_de_costo_id',$ceco)->whereIn('mes',[intval($this->fecha_de_pedido)+1,intval($this->fecha_de_pedido)+2])->sum('monto');
            $monto_usado = DB::table('montos_usado_validar_pedido')->where('fecha_de_pedido',$this->fecha_de_pedido)->where('centro_de_costo_id',$ceco)->first();
           if($monto_usado != NULL){
            $monto_usado = $monto_usado->total;
           }else{
            $monto_usado = 0;
           }
           $this->monto_disponible = $monto_asignado - $monto_usado;
        }else{
            $this->monto_disponible = 0;
            $this->cantidad_materiales_nuevos = 0;
        }
        $this->emitTo('planificador.validar-solicitud-de-articulo.tabla','cambiarSolicitud',$this->solicitud_id);
    }

    public function mostrarPedidos($operario_id,$operario,$estado){
        if($operario_id > 0){
            $this->open = true;
            $this->operario_id = $operario_id;
            $this->operario = $operario;
            $this->estado = $estado;
        }
        $this->solicitudes = SolicitudDePedido::where('solicitante',$this->operario_id)->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('estado',$this->estado)->get();

    }

    public function render()
    {
        return view('livewire.planificador.validar-solicitud-de-articulo.modal');
    }
}
