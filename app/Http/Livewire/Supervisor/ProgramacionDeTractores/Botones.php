<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\ProgramacionDeTractor;
use Livewire\Component;

class Botones extends Component
{

    public $programacion_id = 0;
    public $boton_activo = false;

    protected $listeners = ['obtener_programacion'];

    public function obtener_programacion($id){
        $this->programacion_id = $id;
        $this->boton_activo = $this->programacion_id > 0;
    }

    public function imprimir(){
        $this->emitTo('supervisor.programacion-de-tractores.imprimir','abrirModal');
    }

    public function anular(){
        if($this->programacion_id > 0){
            $programacion = ProgramacionDeTractor::find($this->programacion_id);
            if($programacion->fecha < now()->toDateString()){
                $this->emit('alerta',['center','error','No se puede eliminar']);
            }else{
                $programacion->esta_anulado = 1;
                $programacion->save();
                $this->programacion_id = 0;
                $this->emitTo('supervisor.programacion-de-tractores.tabla','render');
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
