<?php

namespace App\Http\Livewire\Planificador\IngresoArticulos;

use App\Exports\MissingAmountExport;
use App\Models\DetalleDeSolicitudDePedido;
use App\Models\FechaDePedido;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Importar extends Component
{
    public $open;
    public $sede_id;
    public $pedido_id;
    public $pedidos;

    protected $listeners = ['abrirModal','obtenerSede'];

    public function mount($sede_id){
        $this->open = false;
        $this->sede_id = $sede_id;
        $this->pedido_id = 0;
        $this->pedidos = FechaDePedido::latest()->get();
    }

    public function abrirModal(){
        $this->open = true;
    }

    public function exportar(){
        if($this->sede_id > 0 && $this->pedido_id > 0){
            $formato = DetalleDeSolicitudDePedido::where('fecha_de_pedido_id',$this->pedido_id)->get();
            return Excel::download(new MissingAmountExport($formato),'Formato para el ingreso de materiales.xlsx');
        }else{
            $this->emit('alerta',['center','warning','Ingrese la fecha de pedido']);
        }
    }

    public function obtenerSede($sede_id){
        $this->sede_id = $sede_id;
    }

    public function render()
    {
        return view('livewire.planificador.ingreso-articulos.importar');
    }
}
