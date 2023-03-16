<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaTractoristas extends Component
{
    public $open;
    public $tractorista;
    public $supervisor;
    public $supervisores;

    protected $listeners = ['abrirModal'];

    public function mount(){
        $this->open = false;
        $this->tractorista = 0;
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

    public function updatedTractorista(){
        $this->emitTo('supervisor.programacion-de-tractores.modal','obtenerTractorista',$this->tractorista);
        $this->open = false;
    }

    public function render()
    {
        $tractoristas = User::doesnthave('roles')->where('supervisor',$this->supervisor)->get();

        return view('livewire.supervisor.programacion-de-tractores.lista-tractoristas',compact('tractoristas'));
    }
}
