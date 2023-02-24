<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Lote;

use App\Models\Lote;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $lote_id;

    public function mount()
    {
        $this->lote_id = 0;
    }

    public function seleccionar($id){
        $this->lote_id = $id;
        $this->emitTo('planificador.importar-datos.lote.botones','obtenerLote',$id);

    }

    public function render()
    {
        $lotes = Lote::paginate(6);

        return view('livewire.planificador.importar-datos.lote.tabla',compact('lotes'));
    }
}
