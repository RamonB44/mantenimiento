<?php

namespace App\Http\Livewire\Operario\SolicitarArticuloNuevo;

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

    protected $listeners = ['cambiarImplemento'];

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

    public function cambiarImplemento($id){
        if($id > 0){
            $this->implemento_id = $id;
            if(SolicitudDePedido::where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('implemento_id',$this->implemento_id)->exists()){
                $this->lista_materiales_nuevos = SolicitudDeNuevoArticulo::whereHas('SolicitudDePedido',function($q){
                    $q->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('implemento_id',$this->implemento_id);
                })->get();
            }else{
                $this->lista_materiales_nuevos = [];
            }
        }
    }

    public function seleccionar($id){
        $this->material_nuevo = $id;
        $this->emitTo('operario.solicitar-articulo-nuevo.botones','cambiarMaterialNuevo',$id);
    }

    public function render()
    {

        return view('livewire.operario.solicitar-articulo-nuevo.tabla');
    }
}
