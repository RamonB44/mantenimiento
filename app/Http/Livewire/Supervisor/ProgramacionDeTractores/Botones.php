<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\ProgramacionDeTractor;
use Carbon\Carbon;
use Livewire\Component;

class Botones extends Component
{

    public $programacion_id;
    public $boton_activo;
    public $fecha;
    public $fecha_activa;
    public $yesterday;
    public $today;
    public $tomorrow;

    protected $listeners = ['obtenerProgramacion','obtenerFecha'];

    public function mount(){
        $this->programacion_id = 0;
        $this->boton_activo = false;
        $this->fecha = date('Y-m-d');
        $this->fecha_activa = 'today';
        $this->yesterday = Carbon::yesterday()->isoFormat('Y-MM-DD');
        $this->today = date('Y-m-d');
        $this->tomorrow = Carbon::tomorrow()->isoFormat('Y-MM-DD');
    }

    public function obtenerProgramacion($id){
        $this->programacion_id = $id;
        $this->boton_activo = $this->programacion_id > 0;
    }

    public function imprimir(){
        $this->emitTo('supervisor.programacion-de-tractores.imprimir','abrirModal');
    }

    public function obtenerFecha($fecha){
        $this->fecha = $fecha;
        switch ($this->fecha) {
            case $this->today:
                $this->fecha_activa = 'today';
                break;
            case $this->yesterday:
                $this->fecha_activa = 'yesterday';
                break;
            case $this->tomorrow:
                $this->fecha_activa = 'tomorrow';
                break;
            default:
                $this->fecha_activa = '';
                break;
        }
    }

    public function anular(){
        if($this->programacion_id > 0){
            $programacion = ProgramacionDeTractor::find($this->programacion_id);
            $programacion->esta_anulado = 1;
            $programacion->save();
            $this->programacion_id = 0;
            $this->emitTo('supervisor.programacion-de-tractores.tabla','render');
            $this->emit('alerta',['center','success','Anulado']);
        }else{
            $this->emit('alerta',['center','warning','Ningún registro seleccionado']);
        }
    }

    public function render()
    {
        return view('livewire.supervisor.programacion-de-tractores.botones');
    }
}
