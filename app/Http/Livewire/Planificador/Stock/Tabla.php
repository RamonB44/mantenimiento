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

    protected $listeners = ['obtenerDatos'];

    public function mount($sede_id){
        $this->sede_id = $sede_id;
        $this->operario_id = 0;
    }

    public function obtenerDatos($sede_id,$operario_id) {
        $this->resetPage();
        $this->sede_id = $sede_id;
        $this->operario_id = $operario_id;
    }

    public function render()
    {
        if($this->operario_id > 0){
            $stock = StockOperario::where('user_id',$this->operario_id)->where('cantidad','>',0)->paginate(6);
        }else{
            $stock = StockSede::where('sede_id',$this->sede_id)->paginate(6);
        }

        return view('livewire.planificador.stock.tabla',compact('stock'));
    }
}
