<?php

namespace App\Http\Livewire\Jefe\ReporteHoraxImplemento;

use App\Models\Implemento;
use App\Models\Sede;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Table extends Component
{
    public $data = [];
    public $dias_semana = array(
        1 => 'Lunes',
        2 => 'Martes',
        3 => 'Miércoles',
        4 => 'Jueves',
        5 => 'Viernes',
        6 => 'Sábado',
        7 => 'Domingo'
    );

    public function __construct(){
        Carbon::setLocale('es');
    }

    protected $listeners = [
        'allSelects',
    ];

    public function allSelects($idSede, $idSupervisor, $idImplemento, $Year, $Month, $Semana, $Day)
    {
        // when table is loaded from database
        $this->data = DB::table('vista_reporte_de_implementosxhoras')
        ->where('sede_id', $idSede)
        ->where('supervisor', $idSupervisor)
        ->where('modelo_implemento_id', $idImplemento)
        ->whereYear('fecha', $Year)
        ->whereMonth('fecha', $Month)
        ->whereRaw('WEEK(fecha) = ' . $this->obtener_numero_semana_del_mes( (int) $Month , $Semana))
        // ->groupBy('fecha')
        // ->whereDay('created_at', $Day)
        ->orderBy('fecha')
        ->get();
        // and render data

        // Log:info("Data loaded from database", $this->data);
        $this->emit('render');
        // dd($this->data);
    }

    private function obtener_numero_semana_del_mes($mes, $semana) {
        $fecha = Carbon::createFromDate(date('Y'), $mes)->startOfWeek(); // Obtiene el primer día de la semana del mes indicado
        $fecha->addWeeks($semana - 1); // Avanza a la semana indicada
        return $fecha->weekOfYear; // Devuelve el número de la semana del Año
    }

    public function render()
    {
        return view('livewire.jefe.reporte-horax-implemento.table');
    }
}
