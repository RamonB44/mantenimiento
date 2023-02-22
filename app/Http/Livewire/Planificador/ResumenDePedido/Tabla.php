<?php

namespace App\Http\Livewire\Planificador\ResumenDePedido;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tabla extends Component
{
    public $fecha_de_pedido;
    public $sede_id;
    public $monto_total;
    public $ceco_id;

    protected $listeners = ['cambiarCeco'];

    public function mount($fecha_de_pedido,$sede_id){
        $this->fecha_de_pedido = $fecha_de_pedido;
        $this->sede_id = $sede_id;
        $this->monto_total = 0;
        $this->ceco_id = 0;
    }

    public function cambiarCeco($ceco){
        $this->ceco_id = $ceco;
    }

    public function render()
    {
        if($this->ceco_id > 0){
            $materiales = DB::table('resumen_pedido_por_ceco')->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('sede_id',$this->sede_id)->where('ceco_id',$this->ceco_id);
        }else{
            $materiales = DB::table('resumen_pedido_por_fecha')->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('sede_id',$this->sede_id);
        }
        $this->monto_total = $materiales->sum('total');
        $lista_de_materiales = $materiales->get();
        return view('livewire.planificador.resumen-de-pedido.tabla',compact('lista_de_materiales'));
    }
}
