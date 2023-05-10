<?php

namespace App\Http\Livewire\Planificador\IngresoArticulos;

use App\Models\IngresoArticulo;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $sede_id;

    protected $listeners = ['obtenerSede'];

    public function mount($sede_id){
        $this->sede_id = $sede_id;
    }

    public function obtenerSede($sede_id){
        $this->sede_id = $sede_id;
    }

    public function render()
    {
        $ingreso_materiales = IngresoArticulo::where('sede_id',$this->sede_id)->paginate(6);
        return view('livewire.planificador.ingreso-articulos.tabla',compact('ingreso_materiales'));
    }
}
