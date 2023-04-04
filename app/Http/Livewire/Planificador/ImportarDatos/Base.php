<?php

namespace App\Http\Livewire\Planificador\ImportarDatos;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Base extends Component
{
    public $tablas;
    public $tabla;

    public function mount(){
        $this->tablas = ['implemento','tractor','lote','usuario','articulo','centro de costo','epp','labor','rutinario','fecha pedidos'];
        $this->tabla = "";
    }

    public function descargarRespaldo(){
        $path = Storage::disk('public')->path("\public\\respaldos\\respaldo_mantenimiento.sql");
        return response()->download($path);
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.base');
    }
}
