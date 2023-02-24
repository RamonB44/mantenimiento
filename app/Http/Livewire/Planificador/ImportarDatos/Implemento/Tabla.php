<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Implemento;

use App\Models\Implemento;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $implemento_id;

    public function mount()
    {
        $this->implemento_id = 0;
    }

    public function seleccionar($id){
        $this->implemento_id = $id;
        $this->emitTo('planificador.importar-datos.implemento.botones','obtenerImplemento',$id);

    }

    public function render()
    {
        $implementos = Implemento::paginate(6);

        return view('livewire.planificador.importar-datos.implemento.tabla',compact('implementos'));
    }
}
