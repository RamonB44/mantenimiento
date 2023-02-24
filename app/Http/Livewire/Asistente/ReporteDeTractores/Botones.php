<?php

namespace App\Http\Livewire\Asistente\ReporteDeTractores;

use App\Models\ReporteDeTractor;
use Livewire\Component;

class Botones extends Component
{
    public $reporte_id = 0;
    public $boton_activo = false;

    protected $listeners = ['obtenerReporte'];

    public function obtenerReporte($id){
        $this->reporte_id = $id;
    }

    public function render()
    {
        $this->boton_activo = $this->reporte_id > 0;

        return view('livewire.asistente.reporte-de-tractores.botones');
    }
}
