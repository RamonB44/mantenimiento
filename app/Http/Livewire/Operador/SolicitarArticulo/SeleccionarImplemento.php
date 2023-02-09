<?php

namespace App\Http\Livewire\Operador\SolicitarArticulo;

use App\Models\Implemento;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SeleccionarImplemento extends Component
{
    public $implemento_id;

    public function mount(){
        $this->implemento_id = 0;
    }

    public function render()
    {
        $implementos = Implemento::where('responsable',Auth::user()->id)->get();

        return view('livewire.operador.solicitar-articulo.seleccionar-implemento',compact('implementos'));
    }
}
