<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Lote;

use App\Models\Cultivo;
use App\Models\Fundo;
use App\Models\Lote;
use App\Models\Sede;
use App\Models\User;
use Exception;
use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $sede_id;
    public $sedes;
    public $fundo;
    public $lote;
    public $lote_id;
    public $cultivo;
    public $encargado;

    protected $listeners = ['abrirModal','eliminar'];

    public function rules() {
        return [
            'sede_id' => 'required|exists:sedes,id',
            'fundo' => 'required',
            'lote' => 'required|unique:lotes,lote,'.$this->lote_id,
            'cultivo' => 'required',
            'encargado' => 'required|exists:users,id'
        ];
    }

    public function mount(){
        $this->open = false;
        $this->sede_id = 0;
        $this->sedes = Sede::all();
        $this->fundo = "";
        $this->lote = "";
        $this->lote_id = 0;
        $this->cultivo = "";
        $this->encargado = 0;
    }

    public function abrirModal($id) {
        $this->lote_id = $id;
        if($id > 0) {
            $lote = Lote::find($id);
            $this->sede_id = $lote->Fundo->sede_id;
            $this->fundo = $lote->Fundo->fundo;
            $this->lote = $lote->lote;
            $this->cultivo = $lote->Cultivo->cultivo;
            $this->encargado = $lote->encargado;
        }
        $this->open = true;
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open','sedes');
            $this->resetValidation();
        }
    }

    public function registrar(){
        $this->validate();
        $fundo = Fundo::firstOrCreate(
            ['fundo' => strtoupper($this->fundo)],
            ['sede_id' => $this->sede_id]
        );

        $cultivo = Cultivo::firstOrCreate([
            'cultivo' => strtoupper($this->cultivo)
        ]);

        if($this->lote_id > 0) {

            $lote = Lote::find($this->lote_id);
            $lote->fundo_id = $fundo->id;
            $lote->lote = strtoupper($this->lote);
            $lote->encargado = $this->encargado;
            $lote->cultivo_id = $cultivo->id;
            $lote->save();

            if(Lote::where('fundo_id', $fundo->id)->doesntExist()){
                $fundo::find($fundo->id)->delete();
            }

            if(Lote::where('cultivo_id', $cultivo->id)->doesntExist()){
                $cultivo::find($cultivo->id)->delete();
            }

            $this->emit('alerta',['center','success','Lote editado']);

        }else{
            Lote::create([
                'lote' => strtoupper($this->lote),
                'fundo_id' => $fundo->id,
                'encagado' => $this->encagado,
                'cultivo_id' => $cultivo->id
            ]);

            $this->emit('alerta',['center','success','Lote registrado']);
        }

        $this->resetExcept('sedes');
        $this->emitTo('planificador.importar-datos.lote.tabla','render');
    }

    public function eliminar($id) {
        try {
            Lote::find($id)->delete();
            $this->emitTo('planificador.importar-datos.lote.tabla','render');
        } catch (Exception $e) {
            $this->emit('alerta',['center','error','No se puede eliminar']);
        }
    }

    public function render()
    {
        $encargados = User::whereHas('roles',function($q){ $q->where('name','supervisor'); })->get();

        return view('livewire.planificador.importar-datos.lote.modal',compact('encargados'));
    }
}
