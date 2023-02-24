<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Articulo;

use Livewire\Component;

class Botones extends Component
{
    public $articulo_id = 0;
    public $boton_activo = false;

    protected $listeners = ['obtenerArticulo'];

    public function obtenerArticulo($id){
        $this->articulo_id = $id;
        $this->boton_activo = $id > 0;
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.articulo.botones');
    }
}
