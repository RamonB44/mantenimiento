<?php

namespace App\Http\Livewire\Operador\SolicitarArticulo;

use App\Models\Articulo;
use App\Models\ComponentePorImplemento;
use App\Models\ComponentePorModelo;
use App\Models\Implemento;
use App\Models\ModeloDelImplemento;
use App\Models\PiezaPorModelo;
use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $accion;
    public $implemento_id;
    public $articulo;
    public $componente;
    public $cantidad;

    protected $listeners = ['cambiar_implemento','abrir_modal'];

    public function mount(){
        $this->open = false;
        $this->implemento_id = 0;
        $this->accion = "";
        $this->articulo = 0;
        $this->componente = 0;
        $this->cantidad = 1;
    }

    public function cambiar_implemento($id){
        $this->implemento_id = $id;
    }

    public function abrir_modal($accion){
        $this->accion = $accion;
        $this->open = true;
    }

    public function render()
    {
        if($this->implemento_id > 0){
            if($this->accion == "componente"){
                $modelo_id = Implemento::find($this->implemento_id)->modelo_del_implemento_id;
                $articulos = ComponentePorModelo::where('modelo_id',$modelo_id)->get();
            }else if($this->accion == "pieza"){
                $modelo_id = Implemento::find($this->implemento_id)->modelo_del_implemento_id;
                $componentes = ComponentePorModelo::where('modelo_id',$modelo_id)->get();
                //$articulos = PiezaPorModelo::where('articulo_id',$this->componente)->get();
                $articulos = Articulo::has('PiezaPorModelo',function($q){
                    $q->where('articulo_id',$this->componente);
                })->get();
            }else{
                $articulos = Articulo::where('tipo',strtoupper($this->accion))->get();
            }
            if($this->accion != "pieza"){
                $componentes = [];
            }
        }else{
            $articulos = [];
            $componentes = [];
        }

        return view('livewire.operador.solicitar-articulo.modal',compact('articulos','componentes'));
    }
}
