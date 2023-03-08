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
    public $tractor;
    public $modelo_de_implemento_id;
    public $implemento_id;
    public $labor;
    public $fecha_programacion;
    public $yesterday;
    public $today;
    public $tomorrow;
    public $solicitas;

    public $labores;
    public $modelos_implemento;

    public $programacion_id;

    protected $listeners = ['abrirModal','obtenerFecha'];

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
        $this->tractor = 0;
        $this->modelos_implemento = ModeloDelImplemento::orderBy('modelo_de_implemento','asc')->select('id','modelo_de_implemento')->get();
        $this->modelo_de_implemento_id = 0;
        $this->implemento_id = array();
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
            $this->tractor = $programacion->tractor_id  == null ? -1 : $programacion->tractor_id;
            $this->implemento_id = [];
            foreach($programacion->Implementos as $implemento){
                if(!in_array($implemento->implemento_id,$this->implemento_id)){
                    array_push($this->implemento_id,$implemento->implemento_id);
                }
            }
            $this->labor = $programacion->labor_id;
            $this->solicita = $programacion->solicitante;
            $this->emit('obtenerSelectImplementos',$this->implemento_id);
        }
        $this->open = true;

    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open','fecha','turno','labores','modelos_implemento','fundo','lote','fecha_programacion','yesterday','today','tomorrow','labor','solicita','solicitantes');
            $this->emit('reestablecerSelectImplementos');
            $this->emit('obtenerFecha',$this->fecha);
            $this->resetValidation();
        }
    }

    public function updatedFundo(){
        $this->lote = 0;
    }

    public function updatedFecha(){
        $this->fecha_programacion = Carbon::parse($this->fecha)->isoFormat('dddd').','.Carbon::parse($this->fecha)->isoFormat(' DD').' de '.Carbon::parse($this->fecha)->isoFormat(' MMMM').' del '.Carbon::parse($this->fecha)->isoFormat(' Y');
        $this->reset('tractorista','implemento_id','tractor');
        $this->emit('reestablecerSelectImplementos');
    }

    public function updatedTurno(){
        $this->reset('tractorista','implemento_id','tractor');
        $this->emit('reestablecerSelectImplementos');
    }

    public function registrar(){
        $this->validate();
        if($this->tractor == 0){
            $this->emit('alerta',['center','warning','Seleccione el tractor']);
            return false;
        }

        if($this->implemento_id == []){
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

            foreach($this->implemento_id as $item){
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
            $this->resetExcept('fecha','turno','labores','modelos_implemento','fundo','lote','fecha_programacion','yesterday','today','tomorrow','labor','solicita','solicitantes');

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

            foreach($this->implemento_id as $item){
                ImplementoProgramacion::create([
                    'programacion_de_tractor_id' => $programacion->id,
                    'implemento_id' => $item,
                    'operario' => Implemento::find($item)->responsable,
                    'supervisor' => Auth::user()->id,
                ]);
            }

            $this->emit('alerta',['center','success','Programación Registrada']);

            $this->resetExcept('open','fecha','turno','labores','modelos_implemento','modelo_de_implemento_id','fundo','lote','fecha_programacion','yesterday','today','tomorrow','labor','solicita','solicitantes');
        }
        $this->emit('reestablecerSelectImplementos');
    }


    public function render()
    {
        $fundos = Fundo::where('sede_id',Auth::user()->sede_id)->orderBy('fundo')->get();
        if($this->fundo > 0){
            $lotes = Lote::where('fundo_id',$this->fundo)->get();
        }else{
            $lotes = [];
        }

        if(ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0)->exists()){
            if($this->programacion_id > 0){
                $tractoristas = User::doesnthave('roles')->where('sede_id',Auth::user()->sede_id)->whereDoesnthave('ProgramacionDeTractor',function($q){
                    $q->where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0)->whereNotIn('id',[$this->programacion_id]);
                })->where('is_active',true)->orderBy('name','asc')->get();
                $tractores = Tractor::where('sede_id',Auth::user()->sede_id)->whereDoesnthave('ProgramacionDeTractor',function($q){
                    $q->where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0)->whereNotIn('id',[$this->programacion_id]);
                })->orderBy(
                    ModeloDeTractor::select('modelo_de_tractor')
                        ->whereColumn('tractors.modelo_de_tractor_id', 'modelo_de_tractors.id'),
                    'asc'
                )->orderBy('numero','asc')->get();
                $implementos = Implemento::where('sede_id',Auth::user()->sede_id)->whereDoesnthave('ImplementoProgramacion',function($q){
                    $q->join('programacion_de_tractors','programacion_de_tractors.id', '=', 'implemento_programacions.programacion_de_tractor_id')->where('programacion_de_tractors.fecha',$this->fecha)->where('programacion_de_tractors.turno',$this->turno)->where('programacion_de_tractors.esta_anulado',0)->whereNotIn('programacion_de_tractors.id',[$this->programacion_id]);
                });
            }else{
                $tractoristas = User::doesnthave('roles')->where('sede_id',Auth::user()->sede_id)->whereDoesnthave('ProgramacionDeTractor',function($q){
                    $q->where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0);
                })->where('is_active',true)->orderBy('name','asc')->get();
                $tractores = Tractor::where('sede_id',Auth::user()->sede_id)->whereDoesnthave('ProgramacionDeTractor',function($q){
                    $q->where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0);
                })->orderBy(
                    ModeloDeTractor::select('modelo_de_tractor')
                        ->whereColumn('tractors.modelo_de_tractor_id', 'modelo_de_tractors.id'),
                    'asc'
                )->orderBy('numero','desc')->get();
                $implementos = Implemento::where('sede_id',Auth::user()->sede_id)->whereDoesnthave('ImplementoProgramacion',function($q){
                    $q->join('programacion_de_tractors','programacion_de_tractors.id', '=', 'implemento_programacions.programacion_de_tractor_id')->where('programacion_de_tractors.fecha',$this->fecha)->where('programacion_de_tractors.turno',$this->turno)->where('programacion_de_tractors.esta_anulado',0);
                });
            }
        }else{
            $tractoristas = User::doesnthave('roles')->where('sede_id',Auth::user()->sede_id)->where('is_active',true)->orderBy('name','asc')->get();
            $tractores = Tractor::where('sede_id',Auth::user()->sede_id)->orderBy(
                ModeloDeTractor::select('modelo_de_tractor')
                    ->whereColumn('tractors.modelo_de_tractor_id', 'modelo_de_tractors.id'),
                'asc'
            )->orderBy('numero','asc')->get();
            $implementos = Implemento::where('sede_id',Auth::user()->sede_id);


        }
        if($this->modelo_de_implemento_id > 0){
            $implementos = $implementos->where('modelo_del_implemento_id',$this->modelo_de_implemento_id);
        }
        $implementos = $implementos->orderBy('numero','asc')->get();
        $this->emit('estiloSelect2');
        return view('livewire.supervisor.programacion-de-tractores.modal',compact('fundos','lotes','tractoristas','tractores','implementos'));
    }
}
