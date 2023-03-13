<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Tractor;

use App\Models\ModeloDeTractor;
use App\Models\Sede;
use App\Models\Tractor;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $tractor_id;
    public $sede_id;
    public $sedes;
    public $modelo_de_tractor;
    public $modelo_de_tractor_antiguo;
    public $modelo_de_tractor_actual;
    public $numero;

    protected $listeners = ['abrirModal'];

    public function rules() {
        return [
            'sede_id' => 'required|exists:sedes,id',
            'modelo_de_tractor' => 'required',
            'numero' => [
                'required',
                Rule::unique('tractors')->where(function ($q){
                    return $q->where('modelo_de_tractor_id',$this->modelo_de_tractor_actual)->where('numero',$this->numero)->where('sede_id',$this->sede_id);
                })->ignore($this->tractor_id)
            ]
        ];
    }
    public function mount() {
        $this->open = false;
        $this->sede_id = 0;
        $this->sedes = Sede::select('id','sede')->get();
        $this->modelo_de_tractor = "";
        $this->modelo_de_tractor_antiguo = 0;
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
            $this->modelo_de_tractor_antiguo = $tractor->modelo_de_tractor_id;
            $this->modelo_de_tractor = $tractor->ModeloDeTractor->modelo_de_tractor;
            $this->numero = $tractor->numero;
        }
        $this->tractor_id = $id;
        $this->open = true;
    }

    public function registrar(){
        $this->modelo_de_tractor_actual = ModeloDeTractor::firstOrCreate(['modelo_de_tractor' => strtoupper($this->modelo_de_tractor)])->id;
        $this->validate();
        if($this->tractor_id > 0){
            $tractor = Tractor::find($this->tractor_id);
            $tractor->sede_id = $this->sede_id;
            $tractor->modelo_de_tractor_id = $this->modelo_de_tractor_actual;
            $tractor->numero = $this->numero;
            $tractor->save();
            if(Tractor::where('modelo_de_tractor_id',$this->modelo_de_tractor_antiguo)->doesntExist()){
                ModeloDeTractor::find($this->modelo_de_tractor_antiguo)->delete();
            }
            $this->emit('alerta',['center','success','Actualizado']);
        }else{
            Tractor::create([
                'sede_id' => $this->sede_id,
                'modelo_de_tractor_id' => $this->modelo_de_tractor_actual,
                'numero' => $this->numero
            ]);
            $this->emit('alerta',['center','success','Agregado']);
        }
        $this->emitTo('planificador.importar-datos.tractor.tabla','render');
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
