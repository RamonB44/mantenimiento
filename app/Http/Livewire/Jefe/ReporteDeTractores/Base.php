<?php

namespace App\Http\Livewire\Jefe\ReporteDeTractores;

use App\Models\Sede;
use App\Models\User;
use Livewire\Component;

class Base extends Component
{
    public $sede_id;
    public $sedes;
    public $asistente_id;

    public function mount(){
        $this->sede_id = 0;
        $this->sedes = Sede::all();
    }
    public function updatingSedeId(){
        $this->asistente_id = 0;
    }
    public function updatedSedeId(){
        $this->emit('obtenerAsistente',$this->sede_id,0);
    }
    public function updatedAsistenteId(){
        $this->emit('obtenerAsistente',$this->sede_id,$this->asistente_id);
    }
    public function render()
    {
        if($this->sede_id > 0){
            $asistentes = User::whereHas('roles',function($q){ $q->where('name','asistente'); })->where('sede_id',$this->sede_id)->get();
        }else{
            $asistentes = [];
        }
        return view('livewire.jefe.reporte-de-tractores.base',compact('asistentes'));
    }
}
