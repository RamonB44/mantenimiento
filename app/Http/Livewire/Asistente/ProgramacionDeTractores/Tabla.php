<?php

namespace App\Http\Livewire\Asistente\ProgramacionDeTractores;

use App\Exports\ScheduleSummaryExport;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Tabla extends Component
{
    use WithPagination;

    public $supervisor_id;
    public $fecha;

    protected $listeners = ['obtenerFecha','excel'];

    public function mount($supervisor_id){
        $this->supervisor_id = $supervisor_id;
        $this->fecha = date('Y-m-d');
    }

    public function obtenerFecha($fecha){
        $this->fecha = $fecha;
    }

    public function excel(){
        if($this->fecha == ""){
            $this->emit('alerta',['center','warning','Ingrese la fecha']);
        }else{
            $resumen_programaciones = DB::table('resumen_de_programacion')->where('fecha',$this->fecha)->select('fundo','labor','numero_de_maquinas','solicitante','turno')->orderBy('solicitante','asc')->orderBy('turno','asc')->get();
            return Excel::download(new ScheduleSummaryExport($resumen_programaciones,$this->fecha,8),'Resumen de programacion del '.date_format(date_create($this->fecha),'d-m-Y').'.xlsx');
        }
    }

    public function render()
    {
        $resumen_programaciones = DB::table('resumen_de_programacion')->where('fecha',$this->fecha)->orderBy('solicitante','asc')->orderBy('turno','asc')->paginate(6);

        return view('livewire.asistente.programacion-de-tractores.tabla',compact('resumen_programaciones'));
    }
}
