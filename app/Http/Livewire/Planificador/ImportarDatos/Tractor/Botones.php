<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Tractor;

use App\Models\Tractor;
use Livewire\Component;

class Botones extends Component
{
    public $tractor_id = 0;
    public $boton_activo = false;

    protected $listeners = ['obtenerTractor'];

    public function obtenerTractor($id){
        $this->tractor_id = $id;
        $this->boton_activo = $id > 0;
    }

    public function eliminar(){
        Tractor::find($this->tractor_id)->delete();
        $this->emit('alerta',['center','success','Eliminado']);
        $this->emitTo('planificador.importar-datos.tractor.tabla','render');
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.tractor.botones');
    }
}
