<?php

namespace App\Http\Livewire\Planificador\Stock;

use App\Models\Sede;
use App\Models\User;
use Livewire\Component;

class Base extends Component
{
    public $sede_id;
    public $sedes;
    public $operario_id;
    public $operarios;
    public function mount(){
        $this->sede_id = 0;
        $this->sedes = Sede::all();
        $this->operario_id = 0;
        $this->operarios = [];
    }

    public function updatedSedeId(){
        if($this->sede_id > 0){
            $this->operarios = User::whereHas('roles',function($q){
                $q->where('name','operario');
            })->orderBy('name','asc')->get();
            $this->emit('obtenerDatos',$this->sede_id,$this->operario_id);
        }else{
            $this->operarios = [];
        }
    }

    public function updatedOperarioId(){
        $this->emit('obtenerDatos',$this->sede_id,$this->operario_id);
    }

    public function render()
    {
        return view('livewire.planificador.stock.base');
    }
}
