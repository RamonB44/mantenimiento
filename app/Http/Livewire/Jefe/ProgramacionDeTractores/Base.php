<?php

namespace App\Http\Livewire\Jefe\ProgramacionDeTractores;

use App\Models\Sede;
use App\Models\User;
use Livewire\Component;

class Base extends Component
{
    public $sede_id;
    public $sedes;
    public $supervisor_id;

    public function mount(){
        $this->sede_id = 0;
        $this->sedes = Sede::all();
    }
    public function updatingSedeId(){
        $this->supervisor_id = 0;
    }
    public function updatedSedeId(){
        $this->emit('obtenerSupervisor',$this->sede_id,0);
    }
    public function updatedSupervisorId(){
        $this->emit('obtenerSupervisor',$this->sede_id,$this->supervisor_id);
    }
    public function render()
    {
        if($this->sede_id > 0){
            $supervisores = User::whereHas('roles',function($q){ $q->where('name','supervisor'); })->where('sede_id',$this->sede_id)->get();
        }else{
            $supervisores = [];
        }
        return view('livewire.jefe.programacion-de-tractores.base',compact('supervisores'));
    }
}
