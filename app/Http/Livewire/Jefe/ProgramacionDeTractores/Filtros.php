<?php

namespace App\Http\Livewire\Jefe\ProgramacionDeTractores;

use App\Models\Fundo;
use App\Models\Implemento;
use App\Models\Labor;
use App\Models\Lote;
use App\Models\Tractor;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Filtros extends Component
{
    public $open;
    public $sede_id;
    public $fecha_inicial;
    public $fecha_final;
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

    protected $listeners = ['obtenerSupervisor'];

    public function mount(){
        $this->open = false;
        $this->sede_id = 0;
        $this->fecha_inicial = date('Y-m-d');
        $this->fecha_final = date('Y-m-d');
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

    public  function updatedFechaInicial() {
        if($this->fecha_final < $this->fecha_inicial){
            $this->fecha_final = $this->fecha_inicial;
        }
    }

    public function updatedFechaFinal() {
        if($this->fecha_final < $this->fecha_inicial){
            $this->fecha_inicial = $this->fecha_final;
        }
    }

    public function obtenerSupervisor($sede_id,$supervisor_id){
        $this->resetExcept('fecha_inicial','labores');
        $this->fecha_inicial = date('Y-m-d');
        $this->fecha_final = date('Y-m-d');
        $this->fundos = Fundo::where('sede_id',$sede_id)->orderBy('fundo','asc')->get();
        $this->lotes = [];
        $this->tractoristas = User::doesnthave('roles')->where('sede_id',$sede_id)->orderBy('name','asc')->get(['id','name']);
        $this->tractores = Tractor::where('sede_id',$sede_id)->get();
        $this->implementos = Implemento::where('sede_id',$sede_id)->get();
        $this->sede_id = $sede_id;
    }

    public function updatedFundoid() {
        if ($this->fundoid > 0) {
            $this->lotes = Lote::where('fundo_id',$this->fundoid)->get();
        }else{
            $this->lotes = [];
        }
    }

    public function filtrar(){
        if($this->fecha_inicial != "" && $this->fecha_final != ""){
            $this->emitTo('jefe.programacion-de-tractores.tabla','filtrar',$this->fecha_inicial,$this->fecha_final, $this->turno, $this->fundoid, $this->loteid, $this->tractoristaid, $this->tractorid, $this->implementoid, $this->laborid);
            $this->open = false;
        }else{
            $this->emit('alerta',['center','warning','Ingrese la fecha']);
        }

    }

    public function render()
    {
        return view('livewire.jefe.programacion-de-tractores.filtros');
    }
}
