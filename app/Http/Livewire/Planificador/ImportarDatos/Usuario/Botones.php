<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Usuario;

use Livewire\Component;

class Botones extends Component
{
    public $usuario_id = 0;
    public $boton_activo = false;

    protected $listeners = ['obtener_usuario'];

    public function obtener_usuario($id){
        $this->usuario_id = $id;
        $this->boton_activo = $id > 0;
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.usuario.botones');
    }
}
