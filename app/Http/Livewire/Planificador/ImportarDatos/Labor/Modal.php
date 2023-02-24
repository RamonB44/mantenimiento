<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Labor;

use App\Models\Labor;
use Exception;
use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $labor;
    public $labor_id;

    protected $listeners = ['abrirModal','eliminar'];

    public function rules() {
        return [
            'labor' => 'required|unique:labors,labor,'.$this->labor_id,
        ];
    }

    public function mount() {
        $this->open = false;
        $this->labor = "";
        $this->labor_id = 0;
    }

    public function abrirModal($id) {
        $this->labor_id = $id;
        if($id > 0) {
            $labor = Labor::find($id);
            $this->labor = $labor->labor;
        }
        $this->open = true;
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open');
            $this->resetValidation();
        }
    }

    public function registrar(){
        $this->validate();
        if($this->labor_id > 0) {
            $labor = Labor::find($this->labor_id);
            $labor->labor = strtoupper($this->labor);
            $labor->save();

            $this->emit('alerta',['center','success','Labor editada']);
        }else{
            Labor::create([
                'labor' => strtoupper($this->labor),
            ]);

            $this->emit('alerta',['center','success','Labor registrada']);
        }

        $this->resetExcept();
        $this->emitTo('planificador.importar-datos.labor.tabla','render');
    }

    public function eliminar($id) {
        try {
            Labor::find($id)->delete();
            $this->emitTo('planificador.importar-datos.labor.tabla','render');
        } catch (Exception $e) {
            $this->emit('alerta',['center','error','No se puede eliminar']);
        }

    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.labor.modal');
    }
}
