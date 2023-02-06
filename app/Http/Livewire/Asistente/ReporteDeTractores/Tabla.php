<?php

namespace App\Http\Livewire\Asistente\ReporteDeTractores;

use App\Models\ReporteDeTractor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $reporte_id = 0;

    protected $listeners =['render'];

    public function seleccionar($id){
        $this->reporte_id = $id;
        $this->emitTo('supervisor.reporte-de-tractores.botones','obtener_reporte',$id);
    }

    public function render()
    {
        $this->reporte_id = 0;
        $reporte_de_tractores = ReporteDeTractor::where('sede_id',Auth::user()->sede_id)->where('esta_anulado',0)->orderBy('id','desc')->paginate(6);

        return view('livewire.asistente.reporte-de-tractores.tabla',compact('reporte_de_tractores'));
    }
}
