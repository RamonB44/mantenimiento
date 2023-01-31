<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\Implemento;
use App\Models\ProgramacionDeTractor;
use App\Models\Tractor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $programacion_id = 0;

    protected $listeners =['actualizarTabla'=>'render'];

    public function seleccionar($id){
        $this->programacion_id = $id;
        $this->emit('obtener_programacion',$id);
    }

    public function render()
    {
        $programacion_de_tractores = ProgramacionDeTractor::where('sede_id',Auth::user()->sede_id)->where('esta_anulado',0)->paginate(8);
        $tractores = Tractor::where('sede_id',Auth::user()->sede_id);

        return view('livewire.supervisor.programacion-de-tractores.tabla',compact('programacion_de_tractores'));
    }
}
