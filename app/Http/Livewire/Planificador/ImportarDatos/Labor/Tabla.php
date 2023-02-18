<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Labor;

use App\Models\Labor;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $labor_id;

    public function mount()
    {
        $this->labor_id = 0;
    }

    public function seleccionar($id){
        $this->labor_id = $id;
        $this->emitTo('planificador.importar-datos.labor.botones','obtener_labor',$id);

    }

    public function render()
    {
        $labores = Labor::paginate(6);

        return view('livewire.planificador.importar-datos.labor.tabla',compact('labores'));
    }
}
