<?php

namespace App\Http\Livewire\Supervisor\ProgramacionDeTractores;

use App\Models\Articulo;
use App\Models\ComponentePorModelo;
use App\Models\Implemento;
use App\Models\ProgramacionDeTractor;
use App\Models\Rutinario;
use App\Models\Tarea;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class Imprimir extends Component
{
    public $open = false;

    public $fecha;
    public $data = array();

    protected $listeners = ['abrir_modal'];

    public function mount(){
        $this->fecha = date('Y-m-d',strtotime(date('Y-m-d')."+1 days"));
    }

    public function abrir_modal(){
        $this->open =true;
    }

    public function imprimirProgramacion(){
        if(ProgramacionDeTractor::where('fecha',$this->fecha)->where('esta_anulado',0)->doesntExist()){
            $this->emit('alerta',['center','warning','No existe programacion']);
        }else{
            $titulo = 'Programación del '.$this->fecha.'.pdf';
            $programaciones_am = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno','MAÑANA')->where('esta_anulado',0)->get();
            $programaciones_pm = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno','NOCHE')->where('esta_anulado',0)->get();
            $data = [
                'programaciones_am' => $programaciones_am,
                'programaciones_pm' => $programaciones_pm,
                'fecha' => $this->fecha,
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
            $programaciones_am = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno','MAÑANA')->select('implemento_id')->get();
            $programaciones_pm = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno','NOCHE')->select('implemento_id')->get();
            $fecha = date_create($this->fecha);
            foreach ($programaciones_am as $indice_implemento => $programacion) {
                $implemento = Implemento::find($programacion->implemento_id);
                $data['implementos'][$indice_implemento]['modelo'] = $implemento->ModeloDelImplemento->modelo_de_implemento;
                $data['implementos'][$indice_implemento]['numero'] = $implemento->numero;
                $data['implementos'][$indice_implemento]['fecha'] = $fecha;
                $data['implementos'][$indice_implemento]['turno'] = "MAÑANA";
                $data['implementos'][$indice_implemento]['operario'] = $implemento->Responsable->name;
                $sistemas = ComponentePorModelo::where('modelo_id',$implemento->modelo_del_implemento_id)->select('sistema')->groupBy('sistema')->get();
                foreach($sistemas as $indice_sistema => $sistema) {
                    $data['implementos'][$indice_implemento]['sistemas'][$indice_sistema]['sistema'] = $sistema->sistema;
                    $componentes = ComponentePorModelo::where('modelo_id',$implemento->modelo_del_implemento_id)->where('sistema',$sistema->sistema)->select('articulo_id')->get();
                    foreach($componentes as $indice_componente => $componente) {
                        $articulo = Articulo::find($componente->articulo_id);
                        $data['implementos'][$indice_implemento]['sistemas'][$indice_sistema]['componentes'][$indice_componente]['componente'] = $articulo->articulo;
                        $tareas = Tarea::where('articulo_id', $articulo->id)->select('tarea')->get();
                        $data['implementos'][$indice_implemento]['sistemas'][$indice_sistema]['componentes'][$indice_componente]['tareas'] = [];
                        foreach($tareas as $indice_tarea => $tarea){
                            $data['implementos'][$indice_implemento]['sistemas'][$indice_sistema]['componentes'][$indice_componente]['tareas'][$indice_tarea] = $tarea->tarea;
                        }
                    }
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
