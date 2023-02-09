<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\Fundo;
use App\Models\Implemento;
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
    public $implemento;
    public $labor;

    public $tractores_usados = [];
    public $tractoristas_usados = [];
    public $implementos_usados = [];

    public $programacion_id;

    protected $listeners = ['abrir_modal'];

    protected function rules(){
        return [
            'fundo' => 'required|exists:fundos,id',
            'lote' => 'required|exists:lotes,id',
            'tractorista' => 'required|exists:users,id',
            'labor' => 'required|exists:labors,id',
            'tractor' => 'required|exists:tractors,id',
            'implemento' => 'required|exists:implementos,id',
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
            'tractor.required' => 'Seleccione el tractor',
            'implemento.required' => 'Seleccione el implemento',
            'fecha.required' => 'Seleccione la fecha',
            'shift.required' => 'Seleccione el turno',

            'fundo.exists' => 'La ubicación no existe',
            'lote.exists' => 'El lote no existe',
            'tractorista.exists' => 'El operador no existe',
            'labor.exists' => 'La labor no existe',
            'tractor.exists' => 'El tractor no existe',
            'implemento.exists' => 'El implemento no existe',
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
        $this->implemento = 0;
        $this->labor = 0;
        $this->programacion_id = 0;
    }

    public function abrir_modal($id){
        $this->programacion_id = $id;

        if($id > 0){
            $programacion = ProgramacionDeTractor::find($id);

            $this->fecha = $programacion->fecha;
            $this->turno = $programacion->turno;
            $this->fundo = $programacion->Lote->fundo_id;
            $this->lote = $programacion->lote_id;
            $this->tractorista = $programacion->tractorista;
            $this->tractor = $programacion->tractor_id;
            $this->implemento = $programacion->implemento_id;
            $this->labor = $programacion->labor_id;
        }

        $this->open = true;
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open','fecha','turno');
        }
    }

    public function updatedFundo(){
        $this->lote = 0;
    }

    public function updatedFecha(){
        $this->reset('tractorista','implemento','tractor');
    }

    public function updatedTurno(){
        $this->reset('tractorista','implemento','tractor');
    }

    public function registrar(){
        $this->validate();

        $fundo_obj = Fundo::find($this->fundo);
        if($this->programacion_id > 0){
            $programacion = ProgramacionDeTractor::find($this->programacion_id);

            $programacion->fecha = $this->fecha;
            $programacion->turno = $this->turno;
            $programacion->sede_id = $fundo_obj->sede_id;
            $programacion->lote_id = $this->lote;
            $programacion->tractorista = $this->tractorista;
            $programacion->tractor_id = $this->tractor;
            $programacion->implemento_id = $this->implemento;
            $programacion->labor_id = $this->labor;
            $programacion->validado_por = Auth::user()->id;

            $programacion->save();


            $this->emit('alerta',['center','success','Programación Registrada']);
        }else{
            ProgramacionDeTractor::create([
                'fecha' => $this->fecha,
                'turno' => $this->turno,
                'sede_id' => $fundo_obj->sede_id,
                'lote_id' => $this->lote,
                'tractorista' => $this->tractorista,
                'tractor_id' => $this->tractor,
                'implemento_id' => $this->implemento,
                'labor_id' => $this->labor,
                'validado_por' => Auth::user()->id,
            ]);


            $this->emit('alerta',['center','success','Programación Editada']);
        }

        $this->resetExcept('fecha','turno','open');

        $this->emitTo('supervisor.programacion-de-tractores.tabla','render');
    }


    public function render()
    {
        $this->reset('tractoristas_usados','tractores_usados','implementos_usados');

        $fundos = Fundo::where('sede_id',Auth::user()->sede_id)->get();
        if($this->fundo > 0){
            $lotes = Lote::where('fundo_id',$this->fundo)->get();
        }else{
            $lotes = [];
        }

        if(ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0)->exists()){
            /*--------------Obtener registros ya seleccionados-------------------------------*/
            if($this->programacion_id > 0){
                $repetidos = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0)->whereNotIn('id',[$this->programacion_id])->get();
            }else{
                $repetidos = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno',$this->turno)->where('esta_anulado',0)->get();
            }

                foreach($repetidos as $repetido){
                    array_push($this->tractoristas_usados,$repetido->tractorista);
                    array_push($this->tractores_usados,$repetido->tractor_id);
                    array_push($this->implementos_usados,$repetido->implemento_id);
                }
            }

        $tractoristas = User::where('sede_id',Auth::user()->sede_id)->whereNotIn('id',$this->tractoristas_usados)->get();
        $tractores = Tractor::where('sede_id',Auth::user()->sede_id)->whereNotIn('id',$this->tractores_usados)->get();
        $implementos = Implemento::where('sede_id',Auth::user()->sede_id)->whereNotIn('id',$this->implementos_usados)->get();
        $labores = Labor::all();

        return view('livewire.supervisor.programacion-de-tractores.modal',compact('fundos','lotes','tractoristas','tractores','implementos','labores'));
    }
}
