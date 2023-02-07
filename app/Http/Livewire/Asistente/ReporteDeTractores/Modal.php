<?php

namespace App\Http\Livewire\Asistente\ReporteDeTractores;

use App\Models\ProgramacionDeTractor;
use App\Models\ReporteDeTractor;
use App\Models\Tractor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Modal extends Component
{

    public $open = false;

    public $fecha;
    public $turno;
    
    public $accion;

    public $programacion_id;
    public $correlativo;
    public $horometro_inicial;
    public $horometro_final;

    public $reporte_id;

    protected $listeners = ['abrir_modal'];

    protected function rules(){
        return [
            'correlativo' => 'required|unique:reporte_de_tractors,correlativo,'.$this->programacion_id,
            'programacion_id' => 'required|exists:programacion_de_tractors,id',
            'horometro_final' => "required|gt:horometro_inicial",
        ];
    }

    protected function messages(){
        return [
            'correlativo.required' => 'Ingrese el correlativo',
            'programacion_id.required' => 'Elija una programacion',
            'horometro_final.required' => 'Ingrese el horómetro final',

            'correlativo.unique' => 'Correlativo duplicado',
            'programacion_id.exists' => 'La programacion no existe',
            'horometro_final.gt' => 'El horómetro final debe ser mayor que el inicial'
        ];
    }

    public function mount(){
        $this->programacion_id = 0;
        $this->correlativo = "";
        $this->horometro_inicial = 0;
        $this->horometro_final = 0;
        $this->fecha = date('Y-m-d');
        $this->turno = "MAÑANA";
        $this->accion = "crear";
    }

    public function abrir_modal($id){
        $this->reporte_id = $id;

        if($id > 0){
            $this->accion = "editar";
            $reporte = ReporteDeTractor::find($id);

            $this->programacion_id = $reporte->programacion_de_tractor_id;
            $this->correlativo = $reporte->correlativo;
            $this->horometro_inicial = ProgramacionDeTractor::find($this->programacion_id)->Tractor->horometro;
            $this->horometro_final = $reporte->horometro_final;
        }else{
            $this->accion = "crear";
        }

        $this->open = true;
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open','fecha','turno');
        }
    }

    public function updatedFecha(){
        $this->reset('programacion_id','horometro_inicial','horometro_final');
    }

    public function updatedTurno(){
        $this->reset('programacion_id','horometro_inicial','horometro_final');
    }

    public function registrar(){
        $this->validate();

        if($this->reporte_id > 0){
            $this->accion = "editar";
            $reporte = ReporteDeTractor::find($this->reporte_id);

            $reporte->programacion_de_tractor_id = $this->programacion_id;
            $reporte->correlativo = $this->correlativo;
            $reporte->horometro_inicial = ProgramacionDeTractor::find($this->programacion_id)->Tractor->horometro;
            $reporte->horometro_final = $this->horometro_final;
            $reporte->sede_id = Auth::user()->sede_id;
            $reporte->validado_por = Auth::user()->id;

            $reporte->save();


            $this->emit('alerta',['center','success','Programación Registrada']);
        }else{
            $this->accion = 'crear';
            ReporteDeTractor::create([
                'programacion_de_tractor_id' => $this->programacion_id,
                'correlativo' => $this->correlativo,
                'horometro_inicial' => ProgramacionDeTractor::find($this->programacion_id)->Tractor->horometro,
                'horometro_final' => $this->horometro_final,
                'sede_id' => Auth::user()->sede_id,
                'validado_por' => Auth::user()->id,
            ]);


            $this->emit('alerta',['center','success','Programación Editada']);
        }

        $this->resetExcept('fecha','turno');

        $this->emitTo('asistente.reporte-de-tractores.tabla','render');
    }

    public function updatedProgramacionId(){
        $this->horometro_inicial = ProgramacionDeTractor::find($this->programacion_id)->Tractor->horometro;
        $this->horometro_final = number_format($this->horometro_inicial + 6.4,2);
    }

    public function render()
    {
        $programaciones = ProgramacionDeTractor::doesnthave('ReporteDeTractor')->where('fecha',$this->fecha)->where('sede_id',Auth::user()->sede_id)->where('esta_anulado',0)->get();
        

        if($this->programacion_id > 0){
            $this->emit('focus',['correlativo']);
            $programacion = ProgramacionDeTractor::find($this->programacion_id);
            $fundo = $programacion->Lote->Fundo->fundo;
            $lote = $programacion->Lote->lote;
            $tractorista = $programacion->Tractorista->name;
            $tractor = $programacion->Tractor->ModeloDeTractor->modelo_de_tractor.' '.$programacion->Tractor->numero;
            $implemento = $programacion->Implemento->ModeloDelImplemento->modelo_de_implemento.' '.$programacion->Implemento->numero;
            $labor = $programacion->Labor->labor;
        }else{
            $fundo = "";
            $lote = "";
            $tractorista = "";
            $tractor = "";
            $implemento = "";
            $labor = "";
            $horometro_inicial = 0;
        }

        return view('livewire.asistente.reporte-de-tractores.modal',compact('programaciones','fundo','lote','tractorista','tractor','implemento','labor'));
    }
}
