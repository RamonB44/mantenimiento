<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\Fundo;
use App\Models\Implemento;
use App\Models\ImplementoProgramacion;
use App\Models\Labor;
use App\Models\Lote;
use App\Models\ProgramacionDeTractor;
use App\Models\Tractor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Modal extends Component
{
    public $open = false;

    public $fecha;
    public $turno;
    public $fundo;
    public $lote;
    public $correlativo;
    public $tractorista;
    public $tractor;
    public $implemento_id;
    public $labor;

    public $labores;

    public $programacion_id;

    protected $listeners = ['abrirModal'];

    protected function rules(){
        return [
            'fundo' => 'required|exists:fundos,id',
            'lote' => 'required|exists:lotes,id',
            'tractorista' => 'required|exists:users,id',
            'labor' => 'required|exists:labors,id',
            'fecha' => 'required|date|date_format:Y-m-d',
            'turno' => 'required|in:MAÑANA,NOCHE'
        ];
    }

    protected function messages(){
        return [
            'fundo.required' => 'Seleccione una ubicación',
            'lote.required' => 'Seleccione el lote',
            'tractorista.required' => 'Seleccione al operador',
            'labor.required' => 'Seleccione la labor',
            'fecha.required' => 'Seleccione la fecha',
            'shift.required' => 'Seleccione el turno',

            'fundo.exists' => 'La ubicación no existe',
            'lote.exists' => 'El lote no existe',
            'tractorista.exists' => 'El operador no existe',
            'labor.exists' => 'La labor no existe',
            'fecha.date' => 'Debe ingresar un fecha',
            'date.date_format' => 'Formato incorrecto',
            'fecha.in' => 'El turno no existe',
        ];
    }

    public function mount(){
        $this->fecha = date('Y-m-d',strtotime(date('Y-m-d')."+1 days"));
        $this->turno = "MAÑANA";
        $this->fundo = 0;
        $this->lote = 0;
        $this->tractorista = 0;
        $this->tractor = 0;
        $this->implemento_id = array();
        $this->labor = 0;
        $this->programacion_id = 0;
        $this->labores = Labor::all();
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
            $this->tractor = $programacion->tractor_id;
            $this->implemento_id = [];
            foreach($programacion->Implementos as $implemento){
                array_push($this->implemento_id,$implemento->implemento_id);
            }
            $this->labor = $programacion->labor_id;
        }
        $this->open = true;

        $this->emit('obtenerSelectImplementos',$this->implemento_id);
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open','fecha','turno','labores');
            $this->emit('reestablecerSelectImplementos');
            $this->resetValidation();
        }
    }

    public function updatedFundo(){
        $this->lote = 0;
    }

    public function updatedFecha(){
        $this->reset('tractorista','implemento_id','tractor');
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
            $programacion->implemento_id = $this->implemento_id;
            $programacion->labor_id = $this->labor;
            $programacion->supervisor = Auth::user()->id;

            $programacion->save();


            $this->emit('alerta',['center','success','Programación Editada']);

            $this->resetExcept('fecha','turno','labores');

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
            ]);

            ImplementoProgramacion::where('programacion_de_tractor_id',$programacion->id)->delete();

            foreach($this->implemento_id as $item){
                ImplementoProgramacion::create([
                    'programacion_de_tractor_id' => $programacion->id,
                    'implemento_id' => $item,
                ]);
            }

            $this->emit('alerta',['center','success','Programación Registrada']);

            $this->resetExcept('fecha','turno','open','labores');
        }


        $this->emitTo('supervisor.programacion-de-tractores.tabla','render');
    }


    public function render()
    {
        $fundos = Fundo::whereHas('Lotes',function($q){
            $q->where('encargado',Auth::user()->id);
        })->get();
        if($this->fundo > 0){
            $lotes = Lote::where('fundo_id',$this->fundo)->where('encargado',Auth::user()->id)->get();
        }else{
            $lotes = [];
        }

        if(ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0)->exists()){
            if($this->programacion_id > 0){
                $tractoristas = User::doesnthave('roles')->where('sede_id',Auth::user()->sede_id)->whereDoesnthave('ProgramacionDeTractor',function($q){
                    $q->where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0)->whereNotIn('id',[$this->programacion_id]);
                })->get();
                $tractores = Tractor::where('sede_id',Auth::user()->sede_id)->whereDoesnthave('ProgramacionDeTractor',function($q){
                    $q->where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0)->whereNotIn('id',[$this->programacion_id]);
                })->get();
                $implementos = Implemento::where('sede_id',Auth::user()->sede_id)->whereDoesnthave('ImplementoProgramacion',function($q){
                    $q->join('programacion_de_tractors','programacion_de_tractors.id', '=', 'implemento_programacions.programacion_de_tractor_id')->where('programacion_de_tractors.fecha',$this->fecha)->where('programacion_de_tractors.turno',$this->turno)->where('programacion_de_tractors.esta_anulado',0)->whereNotIn('programacion_de_tractors.id',[$this->programacion_id]);
                })->get();
            }else{
                $tractoristas = User::doesnthave('roles')->where('sede_id',Auth::user()->sede_id)->whereDoesnthave('ProgramacionDeTractor',function($q){
                    $q->where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0);
                })->get();
                $tractores = Tractor::where('sede_id',Auth::user()->sede_id)->whereDoesnthave('ProgramacionDeTractor',function($q){
                    $q->where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0);
                })->get();
                $implementos = Implemento::where('sede_id',Auth::user()->sede_id)->whereDoesnthave('ImplementoProgramacion',function($q){
                    $q->join('programacion_de_tractors','programacion_de_tractors.id', '=', 'implemento_programacions.programacion_de_tractor_id')->where('programacion_de_tractors.fecha',$this->fecha)->where('programacion_de_tractors.turno',$this->turno)->where('programacion_de_tractors.esta_anulado',0);
                })->get();
            }
        }else{
            $tractoristas = User::doesnthave('roles')->where('sede_id',Auth::user()->sede_id)->get();
            $tractores = Tractor::where('sede_id',Auth::user()->sede_id)->get();
            $implementos = Implemento::where('sede_id',Auth::user()->sede_id)->get();
        }

        $this->emit('estiloSelect2');
        return view('livewire.supervisor.programacion-de-tractores.modal',compact('fundos','lotes','tractoristas','tractores','implementos'));
    }
}
