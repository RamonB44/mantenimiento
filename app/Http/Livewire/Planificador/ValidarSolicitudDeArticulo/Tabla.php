<?php

namespace App\Http\Livewire\Planificador\ValidarSolicitudDeArticulo;

use App\Models\DetalleDeSolicitudDePedido;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tabla extends Component
{
    public $implemento_id;
    public $lista_de_materiales;
    public $tipo;
    public $operario_id;
    public $fecha_de_pedido;
    public $monto_total;

    protected $listeners = ['cambiar_implemento'];

    public function mount($implemento_id,$tipo,$fecha_de_pedido,$operario_id){
        $this->implemento_id = $implemento_id;
        $this->tipo = $tipo;
        $this->operario_id = $operario_id;
        $this->fecha_de_pedido = $fecha_de_pedido;
        $this->obtenerListaDeMateriales($implemento_id);
    }

    public function cambiar_implemento($implemento_id){
        $this->implemento_id = $implemento_id;
        $this->obtenerListaDeMateriales($this->implemento_id);
    }

    public function obtenerListaDeMateriales($implemento_id){
        if($implemento_id > 0){
            $consulta = DetalleDeSolicitudDePedido::whereHas('SolicitudDePedido',function($q){
                $q->where('solicitante',$this->operario_id)->where('implemento_id',$this->implemento_id)->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('estado','CERRADO');
            })->where('estado',$this->tipo);
            $this->lista_de_materiales = $consulta->get();
            if($this->tipo == 'VALIDADO'){
                $this->monto_total = floatval($consulta->sum(DB::raw('estimated_price * cantidad_validada')));
            }else{
                $this->monto_total = floatval($consulta->sum(DB::raw('estimated_price * cantidad_solicitada')));
            }
        }else{
            $this->lista_de_materiales = new DetalleDeSolicitudDePedido();
            $this->monto_total = 0;
        }
    }

    public function render()
    {
        return view('livewire.planificador.validar-solicitud-de-articulo.tabla');
    }
}
