<?php

namespace App\Http\Livewire\Asistente\ProgramacionDeTractores;

use App\Models\Fundo;
use App\Models\Labor;
use App\Models\User;
use Livewire\Component;

class Filtros extends Component
{
    public $open;
    public $fecha;
    public $turno;
    public $fundo_id;
    public $fundos;
    public $labor_id;
    public $labores;
    public $solicitante_id;
    public $solicitantes;

    public function mount(){
        $this->open = false;
        $this->fecha = date('Y-m-d');
        $this->turno = "";
        $this->fundo_id = 0;
        $this->fundos = Fundo::orderBy('fundo','asc')->get();
        $this->labor_id = 0;
        $this->labores = Labor::orderBy('labor','asc')->get();
        $this->solicitante_id = 0;
        $this->solicitantes = User::whereHas('roles',function($q){
            $q->where('name','solicitante');
        })->orderBy('name','asc')->get();
    }

    public function render()
    {
        return view('livewire.asistente.programacion-de-tractores.filtros');
    }
}
