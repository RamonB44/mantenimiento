<?php

namespace App\Http\Livewire\Planificador\Stock;

use App\Models\StockOperario;
use App\Models\StockSede;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $sede_id;
    public $operario_id;
    public $articulo;

    protected $listeners = ['obtenerDatos'];

    public function mount($sede_id){
        $this->sede_id = $sede_id;
        $this->operario_id = 0;
        $this->articulo = "";
    }

    public function obtenerDatos($sede_id,$operario_id) {
        $this->resetPage();
        $this->sede_id = $sede_id;
        $this->operario_id = $operario_id;
        $this->articulo = "";
    }

    public function updatedArticulo() {
        $this->emit('focus','articulo');
    }

    public function render()
    {
        if($this->operario_id > 0){
            $stock = StockOperario::where('user_id',$this->operario_id)->where('cantidad','>',0)->get();
        }else{
            $stock = StockSede::where('sede_id',$this->sede_id)->get();
        }
        if($this->articulo != ""){
            $stock = $stock->filter(function($item){
                return false !== stripos($item->Articulo->articulo,$this->articulo);
            });
        }


        return view('livewire.planificador.stock.tabla',compact('stock'));
    }
}
