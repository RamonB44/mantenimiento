<?php

namespace App\Http\Livewire\Asistente\ReporteDeTractores;

use App\Models\ImplementoProgramacion;
use App\Models\ProgramacionDeTractor;
use App\Models\ReporteDeTractor;
use Carbon\Carbon;
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
    public $deshabilitar_horometro_inicial;

    public $reporte_id;

    protected $listeners = ['abrirModal','obtenerFecha'];

    protected function rules(){
        return [
            'correlativo' => 'required',
            'programacion_id' => 'required|exists:programacion_de_tractors,id',
            'horometro_final' => "required|gt:horometro_inicial",
        ];
    }

    protected function messages(){
        return [
            'correlativo.required' => 'Ingrese el correlativo',
            'programacion_id.required' => 'Elija una programacion',
            'horometro_final.required' => 'Ingrese el horómetro final',

            'programacion_id.exists' => 'La programacion no existe',
            'horometro_final.gt' => 'El horómetro final debe ser mayor que el inicial'
        ];
    }

    public function mount(){
        $this->programacion_id = 0;
        $this->correlativo = "";
        $this->horometro_inicial = 0;
        $this->horometro_final = 0;
        $this->fecha = Carbon::yesterday()->isoFormat('Y-MM-DD');
        $this->turno = "MAÑANA";
        $this->accion = "crear";
        $this->deshabilitar_horometro_inicial = true;
    }

    public function abrirModal($id){
        $this->reporte_id = $id;

        if($this->reporte_id > 0){
            $reporte = ReporteDeTractor::find($this->reporte_id);
            $this->accion = "editar";
            $this->programacion_id = $reporte->programacion_de_tractor_id;
            $this->correlativo = $reporte->correlativo;
            $this->horometro_inicial = $reporte->horometro_inicial;
            $this->horometro_final = $reporte->horometro_final;

        }else{
            $this->accion = "crear";
        }

        $this->open = true;
    }

    public function obtenerFecha($fecha,$turno){
        $this->fecha = $fecha;
        $this->turno = $turno;
    }

    public function updatedOpen() {
        if(!$this->open){
            $this->emit('obtenerFecha',$this->fecha,$this->turno);
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
            $reporte->horometro_inicial = $this->horometro_inicial;
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
        $this->emit('obtenerFecha',$this->fecha,$this->turno);
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
            $this->deshabilitar_horometro_inicial = $this->horometro_inicial > 0;
        }else{
            $this->reset('horometro_inicial','horometro_final');
            $this->deshabilitar_horometro_inicial = true;
        }

    }

    public function render()
    {
        $programaciones = ProgramacionDeTractor::doesnthave('ReporteDeTractor')->where('fecha',$this->fecha)->where('turno',$this->turno)->where('sede_id',Auth::user()->sede_id)->where('esta_anulado',0)->get()->sortBy(function($programacion_de_tractor,$key){
            if($programacion_de_tractor->Tractor){
                return $programacion_de_tractor->Tractor->ModeloDeTractor->modelo_de_tractor.' '.$programacion_de_tractor->Tractor->numero;
            }
        });

        if($this->programacion_id > 0){
            $this->emit('focus',['correlativo']);
            $programacion = ProgramacionDeTractor::find($this->programacion_id);
            $solicita = $programacion->Solicitante->name ?? 'NO REGISTRADO';
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
            $solicita = "";
            $fundo = "";
            $lote = "";
            $tractorista = "";
            $tractor = "";
            $implemento = "";
            $labor = "";
            $horometro_inicial = 0;
        }

        return view('livewire.asistente.reporte-de-tractores.modal',compact('programaciones','solicita','fundo','lote','tractorista','tractor','implemento','labor'));
    }
}
