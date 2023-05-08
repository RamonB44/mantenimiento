<?php

namespace App\Http\Livewire\Jefe\ReporteTractorxSolicitante;

use App\Models\Sede;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Select extends Component
{
    public $listSedes = [];
    public $listSolicitante = [];
    public $start_date = null;
    public $end_date = null;

    public $idSede, $idSolicitante;

    public function __construct()
    {
        $this->listSolicitante = User::whereHas('roles', function ($q) {
            $q->where('name', 'solicitante');
        })->get();
        $this->listSedes = Sede::all();

        $this->start_date = Carbon::yesterday()->toString();
        $this->end_date = Carbon::today()->toString();
    }

    public function checkSelects(){

    }

    public function updatedidSede($value)
    {
        $this->idSede = $value;
        $this->checkSelects();
    }

    public function updatedidSolicitante($value)
    {
        $this->idSolicitante = $value;
        $this->checkSelects();
    }

    public function render()
    {
        return view('livewire.jefe.reporte-tractorx-solicitante.select');
    }
}
