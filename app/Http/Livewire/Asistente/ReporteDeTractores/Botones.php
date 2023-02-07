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

    public function render()
    {
        $this->boton_activo = $this->reporte_id > 0;

        return view('livewire.asistente.reporte-de-tractores.botones');
    }
}
