<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Tractor;

use App\Models\Tractor;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $tractor_id;

    public function mount()
    {
        $this->tractor_id = 0;
    }

    public function seleccionar($id){
        $this->tractor_id = $id;
        $this->emitTo('planificador.importar-datos.tractor.botones','obtenerTractor',$id);

    }

    public function render()
    {
        $tractores = Tractor::paginate(6);

        return view('livewire.planificador.importar-datos.tractor.tabla',compact('tractores'));
    }
}
