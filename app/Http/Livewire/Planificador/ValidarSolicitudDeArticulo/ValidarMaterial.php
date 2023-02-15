<?php

namespace App\Http\Livewire\Planificador\ValidarSolicitudDeArticulo;

use App\Models\DetalleDeSolicitudDePedido;
use Livewire\Component;

class ValidarMaterial extends Component
{
    public $open;
    public $articulo_id;
    public $articulo;
    public $unidad_de_medida;
    public $cantidad;
    public $stock;
    public $almacen;

    public function mount($detalle_id){
        $this->open = false;
        $this->obtenerDatos($detalle_id);
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open');
        }
    }

    public function obtenerDatos($detalle_id){
        if($detalle_id > 0){
            $detalle = DetalleDeSolicitudDePedido::find($detalle_id);
            $this->articulo_id = $detalle->Articulo->id;
            $this->articulo = $detalle->Articulo->articulo;
            $this->unidad_de_medida = $detalle->Articulo->UnidadDeMedida->unidad_de_medida;
            $this->cantidad = 0;
            $this->stock = 10;
            $this->almacen = 10;
        }else{
            $this->unidad_de_medida = "";
            $this->cantidad = 0;
            $this->stock = 10;
            $this->almacen = 10;
        }
    }

    public function render()
    {
        return view('livewire.planificador.validar-solicitud-de-articulo.validar-material');
    }
}
