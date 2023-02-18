<?php

namespace App\Http\Livewire\Operario\SolicitarArticuloNuevo;

use App\Models\SolicitudDeNuevoArticulo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Botones extends Component
{
    public $fecha_de_pedido;
    public $implemento_id;
    public $material_nuevo;
    public $boton_activo;

    protected $listeners = ['cambiar_material_nuevo','cambiar_implemento_id'];

    public function mount($implemento_id,$fecha_de_pedido){
        $this->fecha_de_pedido = $fecha_de_pedido;
        $this->implemento_id = $implemento_id;
        $this->material_nuevo = 0;
        $this->boton_activo = false;
    }

    public function cambiar_implemento($id){
        $this->implemento_id = $id;
    }

    public function cambiar_material_nuevo($id){
        $this->material_nuevo = $id;
    }

    public function eliminar(){
        $solicitud = SolicitudDeNuevoArticulo::find($this->material_nuevo);
        Storage::delete($solicitud->imagen);
        $solicitud->delete();
        $this->emitTo('operario.solicitar-articulo-nuevo.tabla','cambiar_implemento',$this->implemento_id);
    }

    public function render()
    {
        $this->boton_activo = $this->material_nuevo > 0;

        return view('livewire.operario.solicitar-articulo-nuevo.botones');
    }
}
