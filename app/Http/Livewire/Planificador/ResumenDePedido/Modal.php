<?php

namespace App\Http\Livewire\Planificador\ResumenDePedido;

use App\Models\CentroDeCosto;
use App\Models\FechaDePedido;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Modal extends Component
{
    public $open;

    public $fecha_de_pedido;
    public $sede_id;
    public $ceco_id;
    public $cecos;
    public $fecha;

    protected $listeners = ['abrirModal'];

    public function mount($fecha_de_pedido, $sede_id){
        $this->open = false;
        $this->fecha_de_pedido = $fecha_de_pedido;
        $this->fecha = FechaDePedido::find($fecha_de_pedido)->fecha_de_pedido;
        $this->sede_id = $sede_id;
        $this->ceco_id = 0;
        $this->cecos = CentroDeCosto::where('sede_id',$sede_id)->get();
    }

    public function abrirModal(){
        $this->open = true;
    }

    public function updatedCecoId(){
        $this->emit('cambiarCeco',$this->ceco_id);
    }

    public function imprimir() {

        $titulo = 'Pedido del '.date_format(date_create($this->fecha),'d-m-Y').'.pdf';
        if($this->ceco_id > 0){
            $materiales = DB::table('resumen_pedido_por_ceco')->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('sede_id',$this->sede_id)->where('ceco_id',$this->ceco_id);
        }else{
            $materiales = DB::table('resumen_pedido_por_fecha')->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('sede_id',$this->sede_id);
        }
        $lista_de_materiales = $materiales->get();
        $monto_total = $materiales->sum('total');
        $data = [
            'lista_de_materiales' => $lista_de_materiales,
            'fecha' => $this->fecha,
            'monto_total' => $monto_total,
            'ceco_id' => $this->ceco_id,
        ];

        if($this->ceco_id > 0){
            $ceco = CentroDeCosto::find($this->ceco_id);
            $data['codigo_ceco'] = $ceco->codigo;
        }

        $pdfContent = PDF::loadView('livewire.planificador.resumen-de-pedido.pdf.resumen-de-pedido', $data)->setPaper('a4')->output();

        return response()->streamDownload(
            fn () => print($pdfContent),
            $titulo
        );
    }

    public function render()
    {
        return view('livewire.planificador.resumen-de-pedido.modal');
    }
}
