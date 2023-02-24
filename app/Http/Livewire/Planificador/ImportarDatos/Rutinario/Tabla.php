<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Rutinario;

use App\Models\Tarea;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $rutinario_id;

    public function mount()
    {
        $this->rutinario_id = 0;
    }

    public function seleccionar($id){
        $this->rutinario_id = $id;
        $this->emitTo('planificador.importar-datos.rutinario.botones','obtenerRutinario',$id);

    }

    public function render()
    {
        $rutinarios = Tarea::where('tipo','RUTINARIO')->paginate(6);

        return view('livewire.planificador.importar-datos.rutinario.tabla',compact('rutinarios'));
    }
}
