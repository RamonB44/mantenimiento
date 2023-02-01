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
    }

    public function abrir_modal($id){
        $this->emitTo('supervisor.programacion-de-tractores.modal','abrir_modal',$id);
    }

    public function imprimir(){
        $this->emitTo('supervisor.programacion-de-tractores.imprimir','abrir_modal');
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
        $this->boton_activo = $this->programacion_id > 0;

        return view('livewire.supervisor.programacion-de-tractores.botones');
    }
}
