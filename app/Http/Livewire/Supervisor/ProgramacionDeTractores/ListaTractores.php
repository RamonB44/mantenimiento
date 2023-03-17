<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\Tractor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaTractores extends Component
{
    public $open;
    public $tractor;
    public $supervisor;
    public $supervisores;

    protected $listeners = ['abrirModal'];

    public function mount(){
        $this->open = false;
        $this->tractor = 0;
        $this->supervisores = User::whereHas('roles',function($q){
            $q->where('name','supervisor');
        })->where('sede_id',Auth::user()->sede_id)->get();
        $this->supervisor = Auth::user()->id;
    }

    public function abrirModal(){
        $this->open = true;
    }

    public function getTractoristaProperty(){
        return User::find($this->tractorista);
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->supervisor = Auth::user()->id;
        }
    }

    public function updatedTractorista(){
        $this->emitTo('supervisor.programacion-de-tractores.modal','obtenerTractorista',$this->tractorista);
        $this->open = false;
    }

    public function render()
    {
        $tractores = Tractor::where('supervisor',$this->supervisor)->get();
        return view('livewire.supervisor.programacion-de-tractores.lista-tractores');
    }
}
