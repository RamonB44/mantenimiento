<?php

namespace App\Http\Livewire\Planificador\IngresoArticulos;

use App\Models\Sede;
use Livewire\Component;

class Base extends Component
{
    public $sede_id;
    public $sedes;

    public function mount(){
        $this->sede_id = 0;
        $this->sedes = Sede::all();
    }

    public function updatedSedeId(){
        $this->emit('obtenerSede',$this->sede_id);
    }

    public function render()
    {
        return view('livewire.planificador.ingreso-articulos.base');
    }
}
