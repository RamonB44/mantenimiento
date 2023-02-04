<?php

namespace App\Http\Livewire\Supervisor\ValidarRutinario;

use App\Models\Articulo;
use App\Models\ComponentePorModelo;
use App\Models\Implemento;
use App\Models\Rutinario;
use App\Models\Tarea;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tareas extends Component
{
    public $implemento_id = 0;
    public $tarea = 0;

    protected $listeners = ['mostrarTareas'];

    public function mostrarTareas($implemento){
        $this->implemento_id = $implemento;
    }

    public function autocompletar(){
        if($this->implemento_id > 0){
            $implemento = Implemento::find($this->implemento_id);
            $componentes = ComponentePorModelo::where('modelo_id',$implemento->modelo_del_implemento_id)->select('articulo_id')->get();
            foreach($componentes as $componente){
                Rutinario::create([

                ]);
            }
        }
    }

    public function render()
    {
        if($this->implemento_id > 0){
            $implemento = Implemento::find($this->implemento_id);
            $sistemas = ComponentePorModelo::where('modelo_id',$implemento->modelo_del_implemento_id)->select('sistema')->groupBy('sistema')->get();
            foreach($sistemas as $indice_sistema => $sistema) {
                if(DB::table('cantidad_de_tareas_por_sistema')->where('sistema',$sistema->sistema)->where('modelo_de_implemento',$implemento->modelo_del_implemento_id)->exists()){
                    $data['sistemas'][$indice_sistema]['sistema'] = $sistema->sistema;
                    $componentes = ComponentePorModelo::where('modelo_id',$implemento->modelo_del_implemento_id)->where('sistema',$sistema->sistema)->select('articulo_id')->get();

                    $cantidad_de_tareas = DB::table('tareas_por_sistema')->where('sistema',$sistema->sistema)->where('modelo_de_implemento',$implemento->modelo_del_implemento_id)->select('cantidad_de_tareas')->first();
                    $data['sistemas'][$indice_sistema]['cantidad_de_tareas'] = $cantidad_de_tareas->cantidad_de_tareas;

                    $data['sistemas'][$indice_sistema]['cantidad_de_tareas'] = $cantidad_de_tareas->cantidad_de_tareas;
                    foreach($componentes as $indice_componente => $componente) {
                        $articulo = Articulo::find($componente->articulo_id);
                        $data['sistemas'][$indice_sistema]['componentes'][$indice_componente]['componente'] = $articulo->articulo;
                        $tareas = Tarea::where('articulo_id', $articulo->id)->select('tarea')->get();
                        $data['sistemas'][$indice_sistema]['componentes'][$indice_componente]['tareas'] = [];
                        foreach($tareas as $indice_tarea => $tarea){
                            $data['sistemas'][$indice_sistema]['componentes'][$indice_componente]['tareas'][$indice_tarea] = $tarea->tarea;
                        }
                    }
                }
            }
        }else{
            $data = [];
        }

        return view('livewire.supervisor.validar-rutinario.tareas',compact('data'));
    }
}
