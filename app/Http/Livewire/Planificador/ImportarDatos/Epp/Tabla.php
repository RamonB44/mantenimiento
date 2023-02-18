<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Epp;

use App\Models\Epp;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $epp_id;

    public function mount()
    {
        $this->epp_id = 0;
    }

    public function seleccionar($id){
        $this->epp_id = $id;
        $this->emitTo('planificador.importar-datos.epp.botones','obtener_epp',$id);

    }

    public function render()
    {
        $epps = Epp::paginate(6);

        return view('livewire.planificador.importar-datos.epp.tabla',compact('epps'));
    }
}
