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
    public $nombreImplemento = "";
    public $dias_ing_esp = array(
        "Monday" => 'Lunes',
        "Tuesday" => 'Martes',
        "Wednesday" => 'Miércoles',
        "Thursday" => 'Jueves',
        "Friday" => 'Viernes',
        "Saturday" => 'Sábado',
        "Sunday" => 'Domingo'
    );

    public function __construct()
    {
        Carbon::setLocale('es');
    }

    protected $listeners = [
        'allSelects',
    ];

    public function allSelects($idSede, $idSupervisor, $idImplemento, $nombreImplemento, $Year, $Month, $Semana, $Day)
    {
        // when table is loaded from database
        $this->data = DB::table('vista_reporte_de_implementosxhoras')
            ->where('sede_id', $idSede)
            ->where('supervisor', $idSupervisor)
            ->where('modelo_implemento_id', $idImplemento)
            // ->where( function($query) use ($nombreImplemento) {
            //     if($nombreImplemento){
            //         return $query->where('implementos','like','%'.$nombreImplemento.'%');
            //     }
            // })
            ->whereYear('fecha', $Year)
            ->whereRaw('WEEK(fecha) = ' . $this->obtener_numero_semana_del_mes((int) $Year, (int) $Month, (int) $Semana))
            // ->groupBy('fecha')
            // ->whereDay('created_at', $Day)
            ->orderBy('fecha')
            ->get();
        // and render data
        $this->nombreImplemento = $nombreImplemento;
        // Log:info("Data loaded from database", $this->data);
        $this->emit('render');
        // dd($this->data);
    }

    private function obtener_numero_semana_del_mes($Year, $mes, $semana)
    {
        $fecha = Carbon::createFromDate($Year, $mes, 1)->startOfWeek(1); // Obtiene el primer día de la semana del mes indicado
        $fecha->addWeeks($semana - 1); // Avanza a la semana indicada
        return $fecha->weekOfYear; // Devuelve el número de la semana del Año
    }

    public function render()
    {
        return view('livewire.jefe.reporte-horax-implemento.table');
    }
}
