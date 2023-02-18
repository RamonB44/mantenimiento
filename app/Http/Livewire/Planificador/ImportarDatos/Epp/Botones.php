<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Epp;

use Livewire\Component;

class Botones extends Component
{
    public $epp_id = 0;
    public $boton_activo = false;

    protected $listeners = ['obtener_epp'];

    public function obtener_epp($id){
        $this->epp_id = $id;
        $this->boton_activo = $id > 0;
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.epp.botones');
    }
}
