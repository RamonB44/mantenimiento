<?php

namespace App\Http\Livewire\Jefe\ReporteDeTractores;

use App\Models\Fundo;
use App\Models\Implemento;
use App\Models\Labor;
use App\Models\Lote;
use App\Models\Tractor;
use App\Models\User;
use Livewire\Component;

class Filtros extends Component
{
    public $open;
    public $sede_id;
    public $fecha;
    public $turno;
    public $fundoid;
    public $loteid;
    public $tractoristaid;
    public $tractorid;
    public $implementoid;
    public $laborid;

    public $fundos;
    public $lotes;
    public $tractoristas;
    public $tractores;
    public $implementos;
    public $labores;

    protected $listeners = ['abrirModal','obtenerAsistente'];

    public function mount(){
        $this->open = false;
        $this->sede_id = 0;
        $this->fecha = date('Y-m-d');
        $this->turno = "";
        $this->fundoid = 0;
        $this->loteid = 0;
        $this->tractoristaid = 0;
        $this->tractorid = 0;
        $this->implementoid = 0;
        $this->laborid = 0;
        $this->fundos = [];
        $this->lotes = [];
        $this->tractoristas = [];
        $this->tractores = [];
        $this->implementos = [];
        $this->labores = Labor::orderBy('labor','asc')->get();
    }

    public function obtenerAsistente($sede_id,$asistente_id){
        $this->resetExcept('fecha','labores');
        $this->fecha = date('Y-m-d');
        $this->fundos = Fundo::where('sede_id',$sede_id)->orderBy('fundo','asc')->get();
        $this->lotes = [];
        $this->tractoristas = User::doesnthave('roles')->where('sede_id',$sede_id)->orderBy('name','asc')->get();
        $this->tractores = Tractor::where('sede_id',$sede_id)->get();
        $this->implementos = Implemento::where('sede_id',$sede_id)->get();
        $this->sede_id = $sede_id;
    }

    public function abrirModal() {
        $this->open = true;
    }

    public function updatedFundoid() {
        if ($this->fundoid > 0) {
            $this->lotes = Lote::where('fundo_id',$this->fundoid)->get();
        }else{
            $this->lotes = [];
        }
    }

    public function filtrar(){
        $this->emitTo('asistente.reporte-de-tractores.tabla','filtrar',$this->fecha, $this->turno, $this->fundoid, $this->loteid, $this->tractoristaid, $this->tractorid, $this->implementoid, $this->laborid);
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.jefe.reporte-de-tractores.filtros');
    }
}
