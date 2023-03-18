<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\Fundo;
use App\Models\Implemento;
use App\Models\ImplementoProgramacion;
use App\Models\Labor;
use App\Models\Lote;
use App\Models\ModeloDelImplemento;
use App\Models\ModeloDeTractor;
use App\Models\ProgramacionDeTractor;
use App\Models\Tractor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Modal extends Component
{
    public $open = false;

    public $fecha;
    public $turno;
    public $solicita;
    public $solicitantes;
    public $fundo;
    public $lote;
    public $correlativo;
    public $tractorista;
    public $nombre_tractorista;
    public $tractor;
    public $nombre_tractor;
    public $implemento;
    public $nombre_implemento;
    public $labor;
    public $fecha_programacion;
    public $yesterday;
    public $today;
    public $tomorrow;
    public $solicitas;

    public $labores;

    public $programacion_id;

    protected $listeners = ['abrirModal','obtenerFecha','obtenerTractorista','obtenerTractor','obtenerImplemento'];

    protected function rules(){
        return [
            'fundo' => 'required|exists:fundos,id',
            'lote' => 'required|exists:lotes,id',
            'tractorista' => 'required|exists:users,id',
            'labor' => 'required|exists:labors,id',
            'fecha' => 'required|date|date_format:Y-m-d',
            'turno' => 'required|in:MAÑANA,NOCHE',
            'solicita' => 'required|exists:users,id',
        ];
    }

    protected function messages(){
        return [
            'fundo.required' => 'Seleccione una ubicación',
            'lote.required' => 'Seleccione el lote',
            'tractorista.required' => 'Seleccione al tractorista',
            'labor.required' => 'Seleccione la labor',
            'fecha.required' => 'Seleccione la fecha',
            'shift.required' => 'Seleccione el turno',
            'solicita.required' => 'Seleccione quien lo solicita',

            'fundo.exists' => 'La ubicación no existe',
            'lote.exists' => 'El lote no existe',
            'tractorista.exists' => 'El tractorista no existe',
            'labor.exists' => 'La labor no existe',
            'fecha.date' => 'Debe ingresar un fecha',
            'date.date_format' => 'Formato incorrecto',
            'fecha.in' => 'El turno no existe',
            'solicita.exists' => 'Seleccione quien lo solicita',
        ];
    }

    public function mount(){
        $this->yesterday = Carbon::yesterday()->isoFormat('Y-MM-DD');
        $this->today = Carbon::today()->isoFormat('Y-MM-DD');
        $this->tomorrow = Carbon::tomorrow()->isoFormat('Y-MM-DD');
        $this->fecha = $this->today;
        $this->turno = "MAÑANA";
        $this->solicitantes = User::whereHas('roles',function($q){
            $q->where('name','solicitante');
        })->where('sede_id',Auth::user()->sede_id)->orderBy('name','asc')->get();
        $this->solicita = 0;
        $this->fundo = 0;
        $this->lote = 0;
        $this->tractorista = 0;
        $this->nombre_tractorista = "";
        $this->tractor = 0;
        $this->nombre_tractor = "";
        $this->implemento = [];
        $this->nombre_implemento = "";
        $this->labor = 0;
        $this->programacion_id = 0;
        $this->labores = Labor::orderBy('labor','asc')->get();
        $this->fecha_programacion = Carbon::parse($this->fecha)->isoFormat('dddd').','.Carbon::parse($this->fecha)->isoFormat(' DD').' de '.Carbon::parse($this->fecha)->isoFormat(' MMMM').' del '.Carbon::parse($this->fecha)->isoFormat(' Y');
    }

    public function obtenerFecha($fecha){
        $this->fecha_programacion = Carbon::parse($fecha)->isoFormat('dddd').','.Carbon::parse($fecha)->isoFormat(' DD').' de '.Carbon::parse($fecha)->isoFormat(' MMMM').' del '.Carbon::parse($fecha)->isoFormat(' Y');
        $this->fecha = $fecha;
    }

    public function abrirModal($id){
        $this->programacion_id = $id;

        if($id > 0){
            $programacion = ProgramacionDeTractor::find($id);

            $this->fecha = $programacion->fecha;
            $this->turno = $programacion->turno;
            $this->fundo = $programacion->Lote->fundo_id;
            $this->lote = $programacion->lote_id;
            $this->tractorista = $programacion->tractorista;
            $this->nombre_tractorista = $programacion->Tractorista->name;
            $this->obtenerTractor($programacion->tractor_id);
            $this->implemento = [];
            foreach($programacion->Implementos as $implemento){
                if(!in_array($implemento->implemento_id,$this->implemento)){
                    array_push($this->implemento,$implemento->implemento_id);
                }
            }
            $this->obtenerImplemento($this->implemento);
            $this->labor = $programacion->labor_id;
            $this->solicita = $programacion->solicitante;
        }
        $this->open = true;

    }

    public function updatedOpen(){
        if(!$this->open){
            $this->reset('tractorista','nombre_tractorista','tractor','nombre_tractor','implemento','nombre_implemento');
            $this->emit('obtenerFecha',$this->fecha);
            $this->resetValidation();
        }
    }

    public function updatedFundo(){
        $this->lote = 0;
    }

    public function updatedFecha(){
        $this->fecha_programacion = Carbon::parse($this->fecha)->isoFormat('dddd').','.Carbon::parse($this->fecha)->isoFormat(' DD').' de '.Carbon::parse($this->fecha)->isoFormat(' MMMM').' del '.Carbon::parse($this->fecha)->isoFormat(' Y');
        $this->reset('tractorista','nombre_tractorista','implemento','nombre_implemento','tractor','nombre_tractor');
    }

    public function updatedTurno(){
        $this->reset('tractorista','nombre_tractorista','implemento','nombre_implemento','tractor','nombre_tractor');
    }

    public function obtenerTractorista(User $tractorista){
        $this->tractorista = $tractorista->id;
        $this->nombre_tractorista = $tractorista->name;
    }

    public function obtenerTractor($tractor){
        if($tractor == null || $tractor == -1){
            $this->tractor = -1;
            $this->nombre_tractor = "AUTOPROPULSADO";
        }else{
            $tractor = Tractor::find($tractor);
            $this->tractor = $tractor->id;
            $this->nombre_tractor = $tractor->ModeloDeTractor->modelo_de_tractor.' '.$tractor->numero;
        }
    }

    public function obtenerImplemento($implemento){
        $this->implemento = $implemento;
        $this->nombre_implemento = "";
        $implementos_asignados = Implemento::whereIn('id',$this->implemento)->get();
        foreach($implementos_asignados as $implemento){
            $this->nombre_implemento = $this->nombre_implemento.''.$implemento->ModeloDelImplemento->modelo_de_implemento.' '.$implemento->numero.', ';
        }
    }

    public function registrar(){
        $this->validate();
        if($this->tractor <= 0 && $this->tractor != -1){
            $this->emit('alerta',['center','warning','Seleccione el tractor']);
            return false;
        }

        if($this->implemento == []){
            $this->emit('alerta',['center','warning','Seleccione el implemento']);
            return false;
        }

        $fundo_obj = Fundo::find($this->fundo);
        if($this->programacion_id > 0){
            $programacion = ProgramacionDeTractor::find($this->programacion_id);

            $programacion->fecha = $this->fecha;
            $programacion->turno = $this->turno;
            $programacion->sede_id = $fundo_obj->sede_id;
            $programacion->lote_id = $this->lote;
            $programacion->tractorista = $this->tractorista;
            $programacion->tractor_id = $this->tractor > 0 ? $this->tractor : null;
            $programacion->labor_id = $this->labor;
            $programacion->supervisor = Auth::user()->id;
            $programacion->solicitante = $this->solicita;

            $programacion->save();

            ImplementoProgramacion::where('programacion_de_tractor_id',$programacion->id)->delete();

            foreach($this->implemento as $item){
                ImplementoProgramacion::firstOrCreate(
                    [
                        'programacion_de_tractor_id' => $programacion->id,
                        'implemento_id' => $item,
                    ],
                    [
                        'operario' => Implemento::find($item)->responsable,
                        'supervisor' => Auth::user()->id,
                    ]
                );
            }

            $this->emit('alerta',['center','success','Programación Editada']);
            $this->emit('obtenerFecha',$this->fecha);
            $this->reset('open','tractorista','nombre_tractorista','tractor','nombre_tractor','implemento','nombre_implemento');

        }else{
            $programacion = ProgramacionDeTractor::create([
                'fecha' => $this->fecha,
                'turno' => $this->turno,
                'sede_id' => $fundo_obj->sede_id,
                'lote_id' => $this->lote,
                'tractorista' => $this->tractorista,
                'tractor_id' => $this->tractor > 0 ? $this->tractor : null,
                'labor_id' => $this->labor,
                'supervisor' => Auth::user()->id,
                'solicitante' => $this->solicita,
            ]);

            foreach($this->implemento as $item){
                ImplementoProgramacion::create([
                    'programacion_de_tractor_id' => $programacion->id,
                    'implemento_id' => $item,
                    'operario' => Implemento::find($item)->responsable,
                    'supervisor' => Auth::user()->id,
                ]);
            }

            $this->emit('alerta',['center','success','Programación Registrada']);

            $this->reset('tractorista','nombre_tractorista','tractor','nombre_tractor','implemento','nombre_implemento');        }
    }


    public function render()
    {
        $fundos = Fundo::where('sede_id',Auth::user()->sede_id)->orderBy('fundo')->get();
        if($this->fundo > 0){
            $lotes = Lote::where('fundo_id',$this->fundo)->orderBy('lote','asc')->get();
        }else{
            $lotes = [];
        }
        $this->emit('estiloSelect2');
        return view('livewire.supervisor.programacion-de-tractores.modal',compact('fundos','lotes'));
    }
}
