<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Ceco;

use Livewire\Component;

class Botones extends Component
{
    public $ceco_id = 0;
    public $boton_activo = false;

    protected $listeners = ['obtener_ceco'];

    public function obtener_ceco($id){
        $this->ceco_id = $id;
        $this->boton_activo = $id > 0;
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.ceco.botones');
    }
}
