<?php

namespace App\Http\Livewire\Planificador\ValidarSolicitudDeArticulo\MaterialNuevo;

use App\Models\SolicitudDeNuevoArticulo;
use App\Models\UnidadDeMedida;
use Livewire\Component;

class Detalle extends Component
{
    public $open;

    public $cantidad_solicitada;
    public $um;
    public $ficha_tecnica;

    public $codigo;
    public $articulo;
    public $tipo;
    public $unidad_de_medida_id;
    public $imagen;
    public $precio;
    public $cantidad;
    public $unidades_de_medida;

    protected  $listeners = ['abrirModal'];

    public function mount(){
        $this->open = false;
        $this->cantidad_solicitada = 0;
        $this->um = "";
        $this->ficha_tecnica = "";
        $this->codigo = "";
        $this->articulo = "";
        $this->tipo = "";
        $this->unidad_de_medida_id = 0;
        $this->imagen = "";
        $this->precio = 0;
        $this->cantidad = 1;
        $this->unidades_de_medida = UnidadDeMedida::all();
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open','unidades_de_medida');
        }
    }

    public function abrirModal($id){
        $solicitud = SolicitudDeNuevoArticulo::find($id);
        $this->cantidad_solicitada = $solicitud->cantidad;
        $this->um = $solicitud->UnidadDeMedida->unidad_de_medida;
        $this->ficha_tecnica = $solicitud->ficha_tecnica;
        $this->articulo = $solicitud->nuevo_articulo;
        $this->unidad_de_medida_id = $solicitud->unidad_de_medida_id;
        $this->imagen = "/storage/".$solicitud->imagen;
        $this->cantidad = $solicitud->cantidad;
        $this->open = true;
    }

    public function render()
    {
        return view('livewire.planificador.validar-solicitud-de-articulo.material-nuevo.detalle');
    }
}
