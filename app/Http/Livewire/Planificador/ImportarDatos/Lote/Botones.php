<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Lote;

use App\Models\Lote;
use Livewire\Component;

class Botones extends Component
{
    public $lote_id = 0;
    public $boton_activo = false;

    protected $listeners = ['obtenerLote'];

    public function obtenerLote($id){
        $this->lote_id = $id;
        $this->boton_activo = $id > 0;
    }

    public function eliminar(){
        Lote::find($this->lote_id)->delete();
        $this->emit('alerta',['center','success','Elimando']);
        $this->emitTo('planificador.importar-datos.lote.tabla','render');
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.lote.botones');
    }
}
