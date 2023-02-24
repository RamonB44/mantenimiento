<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Articulo;

use App\Models\Articulo;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $articulo_id;

    public function mount()
    {
        $this->articulo_id = 0;
    }

    public function seleccionar($id){
        $this->articulo_id = $id;
        $this->emitTo('planificador.importar-datos.articulo.botones','obtenerArticulo',$id);

    }

    public function render()
    {
        $articulos = Articulo::where('tipo','FUNGIBLE')->paginate(6);

        return view('livewire.planificador.importar-datos.articulo.tabla',compact('articulos'));
    }
}
