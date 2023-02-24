<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Labor;

use Livewire\Component;

class Botones extends Component
{
    public $labor_id = 0;
    public $boton_activo = false;

    protected $listeners = ['obtenerLabor'];

    public function obtenerLabor($id){
        $this->labor_id = $id;
        $this->boton_activo = $id > 0;
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.labor.botones');
    }
}
