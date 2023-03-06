<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\Articulo;
use App\Models\ComponentePorModelo;
use App\Models\ProgramacionDeTractor;
use App\Models\Tarea;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Imprimir extends Component
{
    public $open = false;
    public $fecha;

    protected $listeners = ['abrirModal','obtenerFecha'];

    public function mount(){
        $this->fecha = date('Y-m-d');
    }

    public function abrirModal(){
        $this->open = true;
    }

    public function obtenerFecha($fecha){
        $this->fecha = $fecha;
    }

    public function imprimirProgramacion(){
        if(ProgramacionDeTractor::where('fecha',$this->fecha)->where('esta_anulado',0)->doesntExist()){
            $this->emit('alerta',['center','warning','No existe programacion']);
        }else{
            $titulo = 'Programación del '.$this->fecha.'.pdf';
            $programaciones_am = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno','MAÑANA')->where('supervisor',Auth::user()->id)->where('esta_anulado',0)->get();
            $programaciones_pm = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno','NOCHE')->where('supervisor',Auth::user()->id)->where('esta_anulado',0)->get();
            $data = [
                'programaciones_am' => $programaciones_am,
                'programaciones_pm' => $programaciones_pm,
                'fecha' => Carbon::parse($this->fecha)->isoFormat('dddd').','.Carbon::parse($this->fecha)->isoFormat(' DD').' de '.Carbon::parse($this->fecha)->isoFormat(' MMMM').' del '.Carbon::parse($this->fecha)->isoFormat(' Y'),
            ];
            $pdfContent = PDF::loadView('livewire.supervisor.programacion-de-tractores.pdf.programacion-de-tractores', $data)->setPaper('a4', 'landscape')->output();

            return response()->streamDownload(
                fn () => print($pdfContent),
                $titulo
            );
        }
    }

    public function imprimirRutinario(){
        if(ProgramacionDeTractor::where('fecha',$this->fecha)->where('esta_anulado',0)->doesntExist()){
            $this->emit('alerta',['center','warning','No existe programacion']);
        }else{
            $titulo = 'Rutinario del '.$this->fecha.'.pdf';

            $data = [];
            $programaciones = ProgramacionDeTractor::where('fecha',$this->fecha)->where('supervisor',Auth::user()->id)->where('esta_anulado',0)->orderBy('turno','asc')->get();
            $fecha = Carbon::parse($this->fecha)->isoFormat('dddd').','.Carbon::parse($this->fecha)->isoFormat(' DD').' de '.Carbon::parse($this->fecha)->isoFormat(' MMMM').' del '.Carbon::parse($this->fecha)->isoFormat(' Y');
            $indice_implemento = 0;
            foreach ($programaciones as $programacion) {
                foreach($programacion->ImplementoProgramacion as $implemento){
                    //$implemento = Implemento::find($programacion->implemento_id);
                    $data['implementos'][$indice_implemento]['modelo'] = $implemento->Implemento->ModeloDelImplemento->modelo_de_implemento;
                    $data['implementos'][$indice_implemento]['numero'] = $implemento->Implemento->numero;
                    $data['implementos'][$indice_implemento]['fecha'] = $fecha;
                    $data['implementos'][$indice_implemento]['turno'] = $programacion->turno;
                    $data['implementos'][$indice_implemento]['operario'] = $implemento->Implemento->Responsable->name;
                    $sistemas = ComponentePorModelo::where('modelo_id',$implemento->Implemento->modelo_del_implemento_id)->groupBy('sistema_id')->get();
                    foreach($sistemas as $indice_sistema => $sistema) {
                        if(DB::table('cantidad_de_tareas_por_sistema')->where('sistema_id',$sistema->sistema_id)->where('modelo_de_implemento',$implemento->Implemento->modelo_del_implemento_id)->exists()){
                            $data['implementos'][$indice_implemento]['sistemas'][$indice_sistema]['sistema'] = $sistema->Sistema->sistema;
                            $componentes = ComponentePorModelo::where('modelo_id',$implemento->Implemento->modelo_del_implemento_id)->where('sistema_id',$sistema->sistema_id)->select('articulo_id')->get();
                            $cantidad_de_tareas = DB::table('cantidad_de_tareas_por_sistema')->where('sistema_id',$sistema->sistema_id)->where('modelo_de_implemento',$implemento->Implemento->modelo_del_implemento_id)->select('cantidad_de_tareas')->first();
                            $data['implementos'][$indice_implemento]['sistemas'][$indice_sistema]['cantidad_de_tareas'] = $cantidad_de_tareas->cantidad_de_tareas;
                            $restart = 0;
                            foreach($componentes as $indice_componente => $componente) {
                                if (Tarea::where('articulo_id',$componente->articulo_id)->count() > 0){
                                    $articulo = Articulo::find($componente->articulo_id);
                                    $data['implementos'][$indice_implemento]['sistemas'][$indice_sistema]['componentes'][$indice_componente-$restart]['componente'] = $articulo->articulo;
                                    $tareas = Tarea::where('articulo_id', $articulo->id)->select('tarea')->get();
                                    $data['implementos'][$indice_implemento]['sistemas'][$indice_sistema]['componentes'][$indice_componente-$restart]['tareas'] = [];
                                    foreach($tareas as $indice_tarea => $tarea){
                                        $data['implementos'][$indice_implemento]['sistemas'][$indice_sistema]['componentes'][$indice_componente-$restart]['tareas'][$indice_tarea] = $tarea->tarea;
                                    }
                                }else{
                                    $restart++;
                                }
                            }
                        }
                    }
                    $indice_implemento++;
                }
            }

            $pdfContent = PDF::loadView('livewire.supervisor.programacion-de-tractores.pdf.rutinarios', $data)->setPaper('a4')->output();

            return response()->streamDownload(
                fn () => print($pdfContent),
                $titulo
            );
        }
    }

    public function render()
    {
        return view('livewire.supervisor.programacion-de-tractores.imprimir');
    }
}
