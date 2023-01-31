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

    public function render()
    {
        $programacion_de_tractores = ProgramacionDeTractor::where('sede_id',Auth::user()->sede_id)->paginate(8);
        $tractores = Tractor::where('sede_id',Auth::user()->sede_id);

        return view('livewire.supervisor.programacion-de-tractores.tabla',compact('programacion_de_tractores'));
    }
}
