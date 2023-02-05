<?php

namespace App\Http\Livewire\Supervisor\ValidarRutinario;

use App\Models\Articulo;
use App\Models\ComponentePorModelo;
use App\Models\ProgramacionDeTractor;
use App\Models\Rutinario;
use App\Models\Tarea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tareas extends Component
{
    public $implemento = 0;
    public $tarea = 0;

    protected $listeners = ['mostrarTareas'];

    public function mostrarTareas($implemento){
        $this->implemento = $implemento;
    }

    public function autocompletar(){
        if($this->implemento > 0){
            DB::select('call autocompletar_rutinario(?,?)',[$this->implemento,Auth::user()->id]);
            $this->emit('check_all');
        }
    }

    public function toggle_tarea($tarea){
        if(Rutinario::where('programacion_de_tractor_id',$this->implemento)->where('tarea_id',$tarea)->exists()){
            Rutinario::where('programacion_de_tractor_id',$this->implemento)->where('tarea_id',$tarea)->delete();
        }else{
            Rutinario::create([
                'programacion_de_tractor_id' => $this->implemento,
                'tarea_id' => $tarea,
                'validado_por' => Auth::user()->id,
            ]);
        }
    }

    private function listar_tareas(){
        if($this->implemento > 0){
            $implemento = ProgramacionDeTractor::find($this->implemento)->Implemento;
            $sistemas = ComponentePorModelo::where('modelo_id',$implemento->modelo_del_implemento_id)->select('sistema')->groupBy('sistema')->get();
            foreach($sistemas as $indice_sistema => $sistema) {
                if(DB::table('cantidad_de_tareas_por_sistema')->where('sistema',$sistema->sistema)->where('modelo_de_implemento',$implemento->modelo_del_implemento_id)->exists()){
                    $data['sistemas'][$indice_sistema]['sistema'] = $sistema->sistema;
                    $componentes = ComponentePorModelo::where('modelo_id',$implemento->modelo_del_implemento_id)->where('sistema',$sistema->sistema)->select('articulo_id')->get();
                    $cantidad_de_tareas = DB::table('cantidad_de_tareas_por_sistema')->where('sistema',$sistema->sistema)->where('modelo_de_implemento',$implemento->modelo_del_implemento_id)->select('cantidad_de_tareas')->first();
                    $data['sistemas'][$indice_sistema]['cantidad_de_tareas'] = $cantidad_de_tareas->cantidad_de_tareas;
                    $restart = 0;
                    foreach($componentes as $indice_componente => $componente) {
                        if (Tarea::where('articulo_id',$componente->articulo_id)->count() > 0){
                            $articulo = Articulo::find($componente->articulo_id);
                            $data['sistemas'][$indice_sistema]['componentes'][$indice_componente-$restart]['componente'] = $articulo->articulo;
                            $tareas = Tarea::where('articulo_id', $articulo->id)->select('id','tarea')->get();
                            $data['sistemas'][$indice_sistema]['componentes'][$indice_componente-$restart]['tareas'] = [];
                            foreach($tareas as $indice_tarea => $tarea){
                                $data['sistemas'][$indice_sistema]['componentes'][$indice_componente-$restart]['tareas'][$indice_tarea]['id'] = $tarea->id;
                                $data['sistemas'][$indice_sistema]['componentes'][$indice_componente-$restart]['tareas'][$indice_tarea]['tarea'] = $tarea->tarea;
                                $data['sistemas'][$indice_sistema]['componentes'][$indice_componente-$restart]['tareas'][$indice_tarea]['estado'] =  false;
                            }
                        }else{
                            $restart++;
                        }
                    }
                }
            }
        }else{
            $data = [];
        }
        return $data;
    }

    public function render()
    {
        $data = $this->listar_tareas();

        return view('livewire.supervisor.validar-rutinario.tareas',compact('data'));
    }
}
