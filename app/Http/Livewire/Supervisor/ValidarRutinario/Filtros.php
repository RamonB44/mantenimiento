<?php

namespace App\Http\Livewire\Supervisor\ValidarRutinario;

use App\Models\Implemento;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Filtros extends Component
{
    public $open;

    public $fecha;
    public $turno;
    public $operarioid;
    public $implementoid;

    public $operarios;
    public $implementos;

    protected $listeners = ['abrirModal'];

    public function mount(){
        $this->open = false;
        $this->fecha = "";
        $this->turno = "";
        $this->operarioid = 0;
        $this->implementoid = 0;

        $this->operarios = User::whereHas('roles',function($q){ $q->where('name','operario'); })->where('sede_id',Auth::user()->sede_id)->get();
        $this->implementos = Implemento::where('sede_id',Auth::user()->sede_id)->get();
    }

    public function abrirModal() {
        $this->open = true;
    }

    public function filtrar(){
        $this->emitTo('supervisor.validar-rutinario.tabla','filtrar',$this->fecha, $this->turno, $this->operarioid, $this->implementoid);
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.supervisor.validar-rutinario.filtros');
    }
}
