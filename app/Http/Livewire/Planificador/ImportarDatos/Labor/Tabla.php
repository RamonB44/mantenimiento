<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Labor;

use App\Models\Labor;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $labor_id;

    public $labor;

    protected $listeners = ['render','filtrar'];

    public function mount()
    {
        $this->labor_id = 0;
        $this->labor = "";
    }

    public function seleccionar($id){
        $this->labor_id = $id;
        $this->emitTo('planificador.importar-datos.labor.botones','obtenerLabor',$id);
    }

    public function filtrar($labor) {
        $this->resetPage();
        $this->labor = $labor;
    }

    public function render()
    {
        $labores = new Labor();

        if($this->labor != ""){
            $labores = $labores->where('labor','like','%'.$this->labor.'%');
        }

        $labores = $labores->orderBy('labor','ASC')->paginate(6);

        return view('livewire.planificador.importar-datos.labor.tabla',compact('labores'));
    }
}
