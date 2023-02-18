<?php

namespace App\Http\Livewire\Operario\SolicitarArticulo;

use App\Models\DetalleDeSolicitudDePedido;
use App\Models\FechaDePedido;
use App\Models\SolicitudDePedido;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $implemento_id;
    public $fecha_de_pedido;

    protected $listeners = ['cambiar_implemento','render'];

    public function mount($implemento_id,$fecha_de_pedido){
        $this->implemento_id = $implemento_id;
        $this->fecha_de_pedido = $fecha_de_pedido;
    }

    public function cambiar_implemento($id){
        $this->implemento_id = $id;
    }

    public function render()
    {
        $detalle_solicitud_de_pedidos = [];
        try{
            if($this->implemento_id > 0 && $this->fecha_de_pedido > 0){
                $detalle_solicitud_de_pedidos = DB::table('lista_de_detalle_de_pedido')->where('solicitante',Auth::user()->id)->where('implemento_id',$this->implemento_id)->where('fecha_de_pedido',$this->fecha_de_pedido)->select('id','codigo','articulo','tipo','precio','abreviacion','cantidad_solicitada','stock','almacen')->get();
            }
        }catch(Exception $e){
            $detalle_solicitud_de_pedidos = [];
        }
        return view('livewire.operario.solicitar-articulo.tabla',compact('detalle_solicitud_de_pedidos'));
    }
}
