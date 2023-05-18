<?php

namespace App\Http\Livewire\Planificador\ImportarDatosImplementos;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ComponentePorImplemento;

class Tabla extends Component
{
    use WithPagination;

    public $implemento_componente_id;

    public function seleccionar($id){
        $this->implemento_componente_id = $id;
        $this->emitTo('planificador.importar-datos-implementos.botones','obtenerImplementoComponente',$id);
    }

    public function render()
    {
        $componentePorImplemento = ComponentePorImplemento::paginate(6);
        return view('livewire.planificador.importar-datos-implementos.tabla',compact('componentePorImplemento'));
    }
}
