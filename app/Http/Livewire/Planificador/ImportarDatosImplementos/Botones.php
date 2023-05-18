<?php

namespace App\Http\Livewire\Planificador\ImportarDatosImplementos;

use Livewire\Component;

class Botones extends Component
{
    public $implemento_componente_id = 0;
    public $boton_activo = false;

    protected $listeners = ['obtenerImplementoComponente'];

    public function obtenerImplementoComponente($id){
        $this->implemento_componente_id = $id;
        $this->boton_activo = $id > 0;
    }
    public function render()
    {
        return view('livewire.planificador.importar-datos-implementos.botones');
    }
}
