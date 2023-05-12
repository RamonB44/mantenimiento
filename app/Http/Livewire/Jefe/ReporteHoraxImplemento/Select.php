<?php

namespace App\Http\Livewire\Jefe\ReporteHoraxImplemento;

use App\Models\Implemento;
use App\Models\ModeloDelImplemento;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Select extends Component
{
    public $listSedes;
    public $listSupervisors = [];
    public $listImplemento = [];
    public $listMImplemento = [];

    public $listMeses = [1 => 'ENERO', 2 => 'FEBRERO', 3 => 'MARZO', 4 => 'ABRIL', 5 => 'MAYO', 6 => 'JUNIO', 7 => 'JULIO', 8 => 'AGOSTO', 9 => 'SETIEMBRE', 10 => 'OCTUBRE', 11 => 'NOVIEMBRE', 12 => 'DICIEMBRE'];
    public $listWeeks = [1 => 'SEMANA 1', 2 => 'SEMANA 2', 3 => 'SEMANA 3', 4 => 'SEMANA 4', 5 => 'SEMANA 5']; // rellenar deacuerdo al mes escogido
    public $idMonth = 1;

    public $idWeek = 1;
    public $Year = 2023;
    public $Day = 7;
    public $idSede, $idSupervisor, $idImplemento, $idMImplemento;

    public function __construct()
    {
        $this->listSedes = Sede::all();
    }

    public function updatedidSede($value)
    {
        $this->idSede = $value;
        // load supervisors
        $this->listSupervisors = User::whereHas('roles', function ($q) {
            $q->where('name', 'supervisor');
        })
            ->where('sede_id', $value)
            ->get()
            ->pluck('name', 'id')
            ->toArray();
        // dd($this->listSupervisors);
        $this->checkSelects();
    }

    public function updatedidSupervisor($value)
    {
        $this->idSupervisor = $value;
        $this->listImplemento = Implemento::with('ModeloDelImplemento')
            ->where('supervisor', $this->idSupervisor)
            // ->groupBy('modelo_de_implemento')
            ->get()
            ->pluck('ModeloDelImplemento.modelo_de_implemento', 'ModeloDelImplemento.id')
            ->toArray();
        // dd($this->listImplemento);
        $this->checkSelects();
    }

    public function updatedidImplemento($value)
    {
        $this->idImplemento = $value;
        $this->listMImplemento = Implemento::with('ModeloDelImplemento')
            ->select('*')
            ->where('modelo_del_implemento_id', $this->idImplemento)
            ->get();
        // dd($this->listMImplemento);
        $this->checkSelects();
    }

    public function updatedidMImplemento($value)
    {
        $this->idMImplemento = $value;
        // dd($value);
        $this->checkSelects();
    }

    public function updatedidMonth($value)
    {
        $this->idMonth = $value;
        $this->checkSelects();
    }

    public function updatedidWeek($value)
    {
        // Log:info("Updated $value");
        $this->idWeek = $value;
        $this->checkSelects();
    }

    private function checkSelects()
    {
        if ($this->idSede != null && $this->idSupervisor != null  && $this->idImplemento != null) {
            $this->emit('allSelects', $this->idSede, $this->idSupervisor, $this->idImplemento, $this->idMImplemento, $this->Year, $this->idMonth, $this->idWeek, $this->Day);
        }
    }

    public function render()
    {
        return view('livewire.jefe.reporte-horax-implemento.select');
    }
}
