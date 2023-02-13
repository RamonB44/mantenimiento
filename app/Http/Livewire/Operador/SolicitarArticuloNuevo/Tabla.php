<?php

namespace App\Http\Livewire\Operador\SolicitarArticuloNuevo;

use App\Models\SolicitudDeNuevoArticulo;
use App\Models\SolicitudDePedido;
use Livewire\Component;

class Tabla extends Component
{
    public $solicitud_de_pedido;
    public $fecha_de_pedido;
    public $implemento_id;
    public $lista_materiales_nuevos;
    public $material_nuevo = 0;

    protected $listeners = ['cambiar_implemento'];

    public function mount($implemento_id,$fecha_de_pedido){
        $this->fecha_de_pedido = $fecha_de_pedido;
        $this->implemento_id = $implemento_id;
        if($implemento_id > 0 && SolicitudDePedido::where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('implemento_id',$this->implemento_id)->exists()){
            $this->lista_materiales_nuevos = SolicitudDeNuevoArticulo::whereHas('SolicitudDePedido',function($q){
                $q->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('implemento_id',$this->implemento_id);
            })->get();
        }else{
            $this->lista_materiales_nuevos = [];
        }
    }

    public function cambiar_implemento($id){
        $this->implemento_id = $id;
        if($id > 0 && SolicitudDePedido::where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('implemento_id',$this->implemento_id)->exists()){
            $this->lista_materiales_nuevos = SolicitudDeNuevoArticulo::whereHas('SolicitudDePedido',function($q){
                $q->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('implemento_id',$this->implemento_id);
            })->get();
        }else{
            $this->lista_materiales_nuevos = [];
        }
    }

    public function seleccionar($id){
        $this->material_nuevo = $id;
        $this->emitTo('operador.solicitar-articulo-nuevo.botones','cambiar_material_nuevo',$id);
    }

    public function render()
    {

        return view('livewire.operador.solicitar-articulo-nuevo.tabla');
    }
}
