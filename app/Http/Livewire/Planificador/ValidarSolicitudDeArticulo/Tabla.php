<?php

namespace App\Http\Livewire\Planificador\ValidarSolicitudDeArticulo;

use App\Models\DetalleDeSolicitudDePedido;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tabla extends Component
{
    public $solicitud_id;
    public $lista_de_materiales;
    public $tipo;
    public $monto_total;
    public $estado;

    protected $listeners = ['cambiar_solicitud'];

    public function mount($solicitud_id,$tipo,$estado){
        $this->solicitud_id = $solicitud_id;
        $this->tipo = $tipo;
        $this->estado = $estado;
        $this->obtenerListaDeMateriales($solicitud_id);
    }

    public function cambiar_solicitud($solicitud_id){
        $this->solicitud_id = $solicitud_id;
        $this->obtenerListaDeMateriales($this->solicitud_id);
    }

    public function obtenerListaDeMateriales($solicitud_id){
        if($solicitud_id > 0){
            $consulta = DetalleDeSolicitudDePedido::where('solicitud_de_pedido_id',$solicitud_id)->where('estado',$this->tipo);
            $this->lista_de_materiales = $consulta->get();
            if($this->tipo == 'VALIDADO'){
                $this->monto_total = floatval($consulta->sum(DB::raw('precio * cantidad_validada')));
            }else{
                $this->monto_total = floatval($consulta->sum(DB::raw('precio * cantidad_solicitada')));
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
