<?php

namespace App\Http\Livewire\Asistente\ProgramacionDeTractores;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Base extends Component
{
    public $supervisor_id;

    public function mount(){
        $this->supervisor_id = Auth::user()->id;
    }

    public function render()
    {
        return view('livewire.asistente.programacion-de-tractores.base');
    }
}
