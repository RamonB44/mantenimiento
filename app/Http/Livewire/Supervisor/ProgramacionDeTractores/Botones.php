<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\ProgramacionDeTractor;
use Livewire\Component;

class Botones extends Component
{

    public $programacion_id = 0;

    protected $listeners = ['obtener_programacion'];

    public function obtener_programacion($id){
        $this->programacion_id = $id;
    }

    public function abrir_modal($accion){
        $this->emit('abrir_modal',$accion);
    }

    public function anular(){
        if($this->programacion_id > 0){
            $programacion = ProgramacionDeTractor::find($this->programacion_id);
            if($programacion->fecha < now()->toDateString()){
                $this->emit('alerta',['center','error',now()->toDateString()]);
            }else{
                $programacion->esta_anulado = 1;
                $programacion->save();
                $this->programacion_id = 0;
                $this->emitTo('supervisor.programacion-de-tractores.tabla','actualizarTabla');
                $this->emit('alerta',['center','success','Anulado']);
            }
        }else{
            $this->emit('alerta',['center','warning','Ningún registro seleccionado']);
        }
    }

    public function render()
    {
        return view('livewire.supervisor.programacion-de-tractores.botones');
    }
}
