<?php

namespace App\Http\Livewire\Operador\SolicitarArticulo;

use App\Models\DetalleMontoCeco;
use App\Models\FechaDePedido;
use App\Models\Implemento;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Cabecera extends Component
{
    public $implemento_id;
    public $fecha_pedido_id;
    public $fecha_pedido;
    public $fecha_de_apertura;
    public $fecha_de_cierre;
    public $fecha_de_llegada;
    public $monto_asignado;
    public $monto_usado;
    public $mes_de_pedido;
    public $centro_de_costo;

    protected $listeners = ['cambiar_implemento','obtener_montos'];
    
    public function mount($fecha_de_pedido,$existe_pedido,$implemento_id){
        Carbon::setLocale(LC_ALL, 'es_ES');
        if($existe_pedido){
            $pedido = FechaDePedido::find($fecha_de_pedido);
            $this->fecha_pedido_id = $pedido->id;
            $this->fecha_pedido = Carbon::parse($pedido->fecha_de_pedido)->isoFormat('M');
            $this->mes_de_pedido = Carbon::parse($pedido->fecha_de_pedido)->isoFormat('MMMM');
            $this->fecha_de_apertura = $pedido->fecha_de_apertura;
            $this->fecha_de_cierre = Carbon::parse($pedido->fecha_de_cierre)->addDay(1)->diffForHumans();
            $this->fecha_de_llegada = $pedido->fecha_de_llegada;
            $this->monto_asignado = 0;
            $this->monto_usado = 0;
            $this->centro_de_costo = 0;
            $this->implemento_id = $implemento_id;
        }
    }

    public function cambiar_implemento($id){
        $this->implemento_id = $id;
        $this->obtener_montos();
    }

    public function obtener_montos(){
        if($this->implemento_id > 0){
            $this->centro_de_costo = Implemento::find($this->implemento_id)->centro_de_costo_id;
           $this->monto_asignado = DB::table('detalle_monto_cecos_por_meses')->where('centro_de_costo_id',$this->centro_de_costo)->whereIn('mes',[intval($this->fecha_pedido)+1,intval($this->fecha_pedido)+2])->sum('monto');    
           $this->monto_usado = DB::table('monto_usado_solicitud_pedido')->where('fecha_de_pedido_id',$this->fecha_pedido_id)->where('centro_de_costo_id',$this->centro_de_costo)->first()->monto_usado;
        }else{
            $this->reset('monto_asignado','monto_usado','monto_usado','centro_de_costo');
        }
    }

    public function render()
    {
        return view('livewire.operador.solicitar-articulo.cabecera');
    }
}
