<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\ProgramacionDeTractor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $programacion_id = 0;

    protected $listeners =['render'];

    public function seleccionar($id){
        $this->programacion_id = $id;
        $this->emitTo('supervisor.programacion-de-tractores.botones','obtener_programacion',$id);
    }

    public function render()
    {
        $programacion_de_tractores = ProgramacionDeTractor::where('validado_por',Auth::user()->id)->where('esta_anulado',0)->orderBy('id','desc')->paginate(6);

        return view('livewire.supervisor.programacion-de-tractores.tabla',compact('programacion_de_tractores'));
    }
}
