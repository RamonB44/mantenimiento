<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Ceco;

use App\Models\CentroDeCosto;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $ceco_id;

    public function mount()
    {
        $this->ceco_id = 0;
    }

    public function seleccionar($id){
        $this->ceco_id = $id;
        $this->emitTo('planificador.importar-datos.ceco.botones','obtener_ceco',$id);

    }

    public function render()
    {
        $cecos = CentroDeCosto::paginate(6);

        return view('livewire.planificador.importar-datos.ceco.tabla',compact('cecos'));
    }
}
