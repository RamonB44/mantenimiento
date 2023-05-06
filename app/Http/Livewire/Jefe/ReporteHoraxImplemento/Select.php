<?php

namespace App\Http\Livewire\Jefe\ReporteHoraxImplemento;

use App\Models\ModeloDelImplemento;
use App\Models\Sede;
use App\Models\User;
use Livewire\Component;

class Select extends Component
{
    public $listSedes = [];
    public $listSupervisors = [];
    public $listImplemento = [];

    public $listMeses = [1 => 'ENERO', 2 => 'FEBRERO', 3 => 'MARZO', 4 => 'ABRIL', 5 => 'MAYO', 6 => 'JUNIO', 7 => 'JULIO', 8 => 'AGOSTO', 9 => 'SETIEMBRE', 10 => 'OCTUBRE', 11 => 'NOVIEMBRE', 12 => 'DICIEMBRE'];
    public $listWeeks = [1 => '1era Semana', 2 => '2da Semana', 3 => '3ra Semana', 4 => '4ta Semana', 5 => '5ta Semana', 6 => '6ta Semana'];
    public $idMonth = 1;

    public $idWeek = 1;
    public $Year = 2023;
    public $Day = 7;
    public $idSede, $idSupervisor, $idImplemento;

    public function __construct()
    {
        $this->listImplemento = ModeloDelImplemento::all();
        $this->listSupervisors = User::whereHas('roles', function ($q) {
            $q->where('name', 'supervisor');
        })->get();
        $this->listSedes = Sede::all();
    }

    public function updatedidSede($value)
    {
        $this->idSede = $value;
        $this->checkSelects();
    }

    public function updatedidImplemento($value)
    {
        $this->idImplemento = $value;
        $this->checkSelects();
    }

    public function updatedidSupervisor($value)
    {
        $this->idSupervisor = $value;
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
            $this->emit('allSelects', $this->idSede, $this->idSupervisor, $this->idImplemento, $this->Year, $this->idMonth, $this->idWeek, $this->Day);
        }
    }

    public function render()
    {
        // Log::info("rendering");
        return view('livewire.jefe.reporte-horax-implemento.select');
    }
}
