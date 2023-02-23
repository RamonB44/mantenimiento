<?php

namespace App\Http\Livewire\Planificador\ValidarSolicitudDeArticulo\MaterialNuevo;

use App\Models\SolicitudDeNuevoArticulo;
use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $solicitud_id;

    protected $listeners = ['abrirModal','cambiarSolicitud','render'];

    public function mount($solicitud_id) {
        $this->open = false;
        $this->solicitud_id = $solicitud_id;
    }

    public function cambiarSolicitud($id) {
        $this->solicitud_id = $id;
    }

    public function abrirModal() {
        $this->open = true;
    }

    public function render()
    {
        if($this->open){
            $lista_de_materiales_nuevos = SolicitudDeNuevoArticulo::where('solicitud_de_pedido_id',$this->solicitud_id)->where('estado','PENDIENTE')->get();
        }else{
            $lista_de_materiales_nuevos = [];
        }

        return view('livewire.planificador.validar-solicitud-de-articulo.material-nuevo.modal',compact('lista_de_materiales_nuevos'));
    }
}
