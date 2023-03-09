<?php

namespace App\Http\Livewire\Asistente\ReporteDeTractores;

use App\Models\ImplementoProgramacion;
use App\Models\ProgramacionDeTractor;
use App\Models\ReporteDeTractor;
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
    public $solicita;
    public $deshabilitar_horometro_inicial;

    public $reporte_id;

    protected $listeners = ['abrirModal'];

    protected function rules(){
        return [
            'correlativo' => 'required|unique:reporte_de_tractors,correlativo,'.$this->reporte_id,
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
        $this->solicita = 0;
        $this->fecha = date('Y-m-d');
        $this->turno = "MAÑANA";
        $this->accion = "crear";
        $this->deshabilitar_horometro_inicial = true;
    }

    public function abrirModal($id){
        $this->reporte_id = $id;

        if($this->reporte_id > 0){
            $reporte = ReporteDeTractor::find($this->reporte_id);
            $tractor = $reporte->ProgramacionDeTractor->tractor_id;
            $programacion_del_tractor_actual = $reporte->programacion_de_tractor_id;
            $ultima_programacion_del_tractor = ProgramacionDeTractor::where('tractor_id',$tractor)->latest()->first()->id;
            if($programacion_del_tractor_actual == $ultima_programacion_del_tractor){
                $this->accion = "editar";

                $this->programacion_id = $reporte->programacion_de_tractor_id;
                $this->correlativo = $reporte->correlativo;
                $this->horometro_inicial = $reporte->horometro_inicial;
                $this->horometro_final = $reporte->horometro_final;
            }else{
                $this->emit('alerta',['center','warning','Solo se puede editar el último reporte del tractor.']);
                return false;
            }
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
            $reporte->horometro_final = $this->horometro_final;
            $reporte->asistente = Auth::user()->id;

            $reporte->save();

            $this->resetExcept('fecha','turno');
            $this->emit('alerta',['center','success','Programación Editada']);
        }else{
            $this->accion = 'crear';
            if(ProgramacionDeTractor::find($this->programacion_id)->Tractor != null && $this->deshabilitar_horometro_inicial){
                $horometro_de_inicio = ProgramacionDeTractor::find($this->programacion_id)->Tractor->horometro;
            }else{
                $horometro_de_inicio = $this->horometro_inicial;
            }
            ReporteDeTractor::create([
                'programacion_de_tractor_id' => $this->programacion_id,
                'correlativo' => $this->correlativo,
                'horometro_inicial' => $horometro_de_inicio,
                'horometro_final' => $this->horometro_final,
                'sede_id' => Auth::user()->sede_id,
                'asistente' => Auth::user()->id,
            ]);

            $this->resetExcept('fecha','turno','open','accion');
            $this->emit('alerta',['center','success','Programación Registrada']);
        }

        $this->emitTo('asistente.reporte-de-tractores.tabla','render');
    }

    public function updatedProgramacionId(){
        if($this->programacion_id > 0){
            $programacion = ProgramacionDeTractor::find($this->programacion_id);
            if($programacion->tractor == null){
                $implemento_programacion = ImplementoProgramacion::where('programacion_de_tractor_id',$this->programacion_id)->first();
                $this->horometro_inicial = $implemento_programacion->Implemento->horas_de_uso;
                $this->deshabilitar_horometro_inicial = true;
            }else{
                $this->horometro_inicial = $programacion->tractor->horometro;
            }
            $this->horometro_final = "";
            $this->solicita = $programacion->Solicitante == null ? 'NO REGISTRADO' : $programacion->Solicitante->name;
            $this->deshabilitar_horometro_inicial = $this->horometro_inicial > 0;
        }else{
            $this->reset('horometro_inicial','horometro_final');
            $this->deshabilitar_horometro_inicial = true;
        }

    }

    public function render()
    {
        $programaciones = ProgramacionDeTractor::doesnthave('ReporteDeTractor')->where('fecha',$this->fecha)->where('turno',$this->turno)->where('sede_id',Auth::user()->sede_id)->where('esta_anulado',0)->get()->sortBy(function($programacion_de_tractor,$key){
            return $programacion_de_tractor->Tractor->ModeloDeTractor->modelo_de_tractor.' '.$programacion_de_tractor->Tractor->numero;
        });

        if($this->programacion_id > 0){
            $this->emit('focus',['correlativo']);
            $programacion = ProgramacionDeTractor::find($this->programacion_id);
            $fundo = $programacion->Lote->Fundo->fundo;
            $lote = $programacion->Lote->lote;
            $tractorista = $programacion->Tractorista->name;
            $tractor = $programacion->Tractor == null ? 'AUTOPROPULSADO' : $programacion->Tractor->ModeloDeTractor->modelo_de_tractor.' '.$programacion->Tractor->numero;
            $implemento = "";
            foreach ($programacion->ImplementoProgramacion as $indice => $imp) {
                $separador = $indice==0 ? '' : ',';
                $implemento = $implemento.$separador.$imp->Implemento->ModeloDelImplemento->modelo_de_implemento.' '.$imp->Implemento->numero;
            }
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
