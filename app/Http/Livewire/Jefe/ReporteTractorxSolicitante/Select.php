<?php

namespace App\Http\Livewire\Jefe\ReporteTractorxSolicitante;

use App\Models\Sede;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Select extends Component
{
    public $listSedes = [];
    public $listSolicitante = [];
    public $startDate;
    public $endDate;

    public $idSede, $idSolicitante;

    public function __construct()
    {
        $this->listSolicitante = User::whereHas('roles', function ($q) {
            $q->where('name', 'solicitante');
        })->get();
        $this->listSedes = Sede::all();

        $this->startDate = Carbon::yesterday()->format('Y-m-d');
        $this->endDate = Carbon::today()->format('Y-m-d');
    }

    public function checkSelects()
    {
        if ($this->idSede != null && $this->idSolicitante != null  && $this->startDate != null && $this->endDate != null) {
            $this->emit('renderBarChart', $this->startDate, $this->endDate, $this->idSede, $this->idSolicitante);
        }
    }

    public function updatedidSede($value)
    {
        $this->idSede = $value;
        // $this->checkSelects();
    }

    public function updatedidSolicitante($value)
    {
        $this->idSolicitante = $value;
        // $this->checkSelects();
    }

    public function updatedstartDate($value){
        Log::info("Update start date");
        $this->startDate = $value;
        // $this->checkSelects();
    }

    public function updatedendDate($value){
        Log::info("Update end date");
        $this->endDate = $value;
        $this->checkSelects();
    }

    public function btnLoad(){
        $this->checkSelects();
    }

    public function render()
    {
        return view('livewire.jefe.reporte-tractorx-solicitante.select');
    }
}
