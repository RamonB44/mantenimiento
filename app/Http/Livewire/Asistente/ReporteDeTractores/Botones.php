<?php

namespace App\Http\Livewire\Asistente\ReporteDeTractores;

use App\Models\ReporteDeTractor;
use Livewire\Component;

class Botones extends Component
{
    public $reporte_id = 0;
    public $boton_activo = false;

    protected $listeners = ['obtener_reporte'];

    public function obtener_reporte($id){
        $this->reporte_id = $id;
    }

    public function abrir_modal($id){
        $this->emitTo('asistente.reporte-de-tractores.modal','abrir_modal',$id);
    }

    public function anular(){
        if($this->reporte_id > 0){
            $reporte = ReporteDeTractor::find($this->reporte_id);
            if($reporte->fecha < now()->toDateString()){
                $this->emit('alerta',['center','error',now()->toDateString()]);
            }else{
                $reporte->esta_anulado = 1;
                $reporte->save();
                $this->reporte_id = 0;
                $this->emitTo('asistente.reporte-de-tractores.tabla','render');
                $this->emit('alerta',['center','success','Anulado']);
            }
        }else{
            $this->emit('alerta',['center','warning','Ningún registro seleccionado']);
        }
    }

    public function render()
    {
        $this->boton_activo = $this->reporte_id > 0;

        return view('livewire.asistente.reporte-de-tractores.botones');
    }
}
