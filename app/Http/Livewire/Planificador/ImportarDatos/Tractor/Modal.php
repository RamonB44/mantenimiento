<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Tractor;

use App\Models\ModeloDeTractor;
use App\Models\Sede;
use App\Models\Tractor;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $tractor_id;
    public $sede_id;
    public $sedes;
    public $modelo_de_tractor;
    private $modelo_de_tractor_antiguo;
    public $numero;

    protected $listeners = ['abrirModal'];

    public function rules() {
        return [
            'sede_id' => 'required|exists:sedes,id',
            'modelo_de_tractor' => 'required',
            'numero' => 'required|unique:tractors,numero,'.$this->tractor_id,
        ];
    }
    public function mount() {
        $this->open = false;
        $this->sede_id = 0;
        $this->sedes = Sede::select('id','sede')->get();
        $this->modelo_de_tractor = "";
        $this->modelo_de_tractor_antiguo = "";
        $this->numero = 0;
    }

    public function updatedOpen() {
        if (!$this->open){
            $this->resetExcept('open','sedes');
        }
    }

    public function abrirModal($id) {
        if($id > 0){
            $tractor = Tractor::find($id);
            $this->sede_id = $tractor->sede_id;
            $this->modelo_de_tractor_antiguo = $tractor->ModeloDeTractor->modelo_de_tractor;
            $this->modelo_de_tractor = $tractor->ModeloDeTractor->modelo_de_tractor;
            $this->numero = $tractor->numero;
        }
        $this->tractor_id = $id;
        $this->open = true;
    }

    public function registrar(){
        $this->validate();
        $modelo_de_tractor = ModeloDeTractor::firstOrCreate(['modelo_de_tractor' => $this->modelo_de_tractor]);
        if($this->tractor_id > 0){
            $tractor = Tractor::find($this->tractor_id);
            $tractor->sede_id = $this->sede_id;
            $tractor->modelo_de_tractor_id = $modelo_de_tractor->id;
            $tractor->numero = $this->numero;
            $tractor->save();
            if(Tractor::whereHas('ModeloDeTractor',function($q){
                $q->where('modelo_de_tractor',$this->modelo_de_tractor_antiguo);
            })->doesntExist()){
                $modelo_de_tractor_antiguo = ModeloDeTractor::where('modelo_de_tractor',$this->modelo_de_tractor_antiguo)->first();
                ModeloDeTractor::find($modelo_de_tractor_antiguo->id)->delete();
            }
            $this->emit('alerta',['center','success','Actualizado']);
        }else{
            Tractor::create([
                'sede_id' => $this->sede_id,
                'modelo_de_tractor_id' => $modelo_de_tractor->id,
                'numero' => $this->numero
            ]);
            $this->emit('alerta',['center','success','Agregado']);
        }
        $this->resetExcept('sedes');

    }

    public function eliminar($id){
        try {
            Tractor::find($id)->delete();
            $this->emitTo('planificador.importar-datos.tractor.tabla','render');
            $this->emit('alerta',['center','success','Eliminado']);
        } catch (Exception $e) {
            $this->emit('alerta',['center','error','No se puede eliminar']);
        }
    }

    public function render()
    {
        $modelos = ModeloDeTractor::all();

        return view('livewire.planificador.importar-datos.tractor.modal',compact('modelos'));
    }
}
