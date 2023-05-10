<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Usuario;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $usuario_id;

    protected $listeners = ['render','filtrar','obtenerUsuario'];

    public function mount()
    {
        $this->usuario_id = 0;
    }

    public function obtenerUsuario($id){
        $this->usuario_id = $id;
    }

    public function render()
    {
        $usuarios = User::paginate(6);

        return view('livewire.planificador.importar-datos.usuario.tabla',compact('usuarios'));
    }
}
