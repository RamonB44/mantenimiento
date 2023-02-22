<?php

namespace App\Http\Livewire\Planificador\ValidarSolicitudDeArticulo\MaterialNuevo;

use App\Models\SolicitudDeNuevoArticulo;
use Livewire\Component;

class Base extends Component
{
    public $cantidad_materiales_nuevos;
    public $solicitud_id;

    protected $listeners = ['cambiarSolicitud'];

    public function mount($solicitud_id){
        $this->cambiarSolicitud($solicitud_id);
    }

    public function cambiarSolicitud($id) {
        $this->solicitud_id = $id;
        $this->cantidad_materiales_nuevos = SolicitudDeNuevoArticulo::where('solicitud_de_pedido_id',$id)->where('estado','PENDIENTE')->count();
    }

    public function render()
    {
        return view('livewire.planificador.validar-solicitud-de-articulo.material-nuevo.base');
    }
}
