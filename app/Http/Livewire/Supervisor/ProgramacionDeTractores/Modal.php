<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\Fundo;
use App\Models\Implemento;
use App\Models\Labor;
use App\Models\Lote;
use App\Models\Tractor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Modal extends Component
{
    public $open = false;
    public $accion = "crear";

    public $fecha;
    public $turno;
    public $fundo;
    public $lote;
    public $correlativo;
    public $tractorista;
    public $tractor;
    public $horometro_inicial;
    public $horometro_final;
    public $implemento;
    public $labor;

    public $tractores_usados = [];
    public $tractoristas_usados = [];
    public $implementos_usados = [];

    protected $listeners = ['abrir_modal'];

    protected function rules(){
        return [
            'fundo' => 'required|exists:fundos,id',
            'lote' => 'required|exists:lotes,id',
            'correlativo' => 'required|gte:1',
            'tractorista' => 'required|exists:users,id',
            'labor' => 'required|exists:labors,id',
            'tractor' => 'required|exists:tractors,id',
            'implemento' => 'required|exists:implements,id',
            'fecha' => 'required|date|date_format:Y-m-d',
            'turno' => 'required|in:MAÑANA,NOCHE',
            'horometro_final'
        ];
    }

    public function mount(){
        $this->fecha = date('Y-m-d');
        $this->turno = "MAÑANA";
        $this->fundo = 0;
        $this->lote = 0;
        $this->tractorista = 0;
        $this->tractor = 0;
        $this->implemento = "";
        $this->labor = "";
    }

    public function abrir_modal($accion){
        $this->accion = $accion;
        $this->open = true;
    }

    public function updatedFundo(){
        $this->lote = 0;
    }


    public function render()
    {
        $fundos = Fundo::where('sede_id',Auth::user()->sede_id)->get();
        if($this->fundo > 0){
            $lotes = Lote::where('fundo_id',$this->fundo)->get();
        }else{
            $lotes = [];
        }
        $tractoristas = User::where('sede_id',Auth::user()->sede_id)->get();
        $tractores = Tractor::where('sede_id',Auth::user()->sede_id)->get();
        $implementos = Implemento::where('sede_id',Auth::user()->sede_id)->get();
        $labores = Labor::all();

        return view('livewire.supervisor.programacion-de-tractores.modal',compact('fundos','lotes','tractoristas','tractores','implementos','labores'));
    }
}
