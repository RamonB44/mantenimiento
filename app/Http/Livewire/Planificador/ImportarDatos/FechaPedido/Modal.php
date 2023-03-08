<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\FechaPedido;

use App\Models\FechaDePedido;
use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $fecha_de_pedido_id;
    public $fecha_de_apertura;
    public $fecha_de_cierre;
    public $fecha_de_pedido;
    public $fecha_de_llegada;

    protected $listeners = ['abrirModal'];

    public function rules() {
        return [
            'fecha_de_apertura' => 'required|unique:fecha_de_pedidos,fecha_de_apertura,'.$this->fecha_de_pedido_id,
            'fecha_de_cierre' => 'required|unique:fecha_de_pedidos,fecha_de_cierre,'.$this->fecha_de_pedido_id,
            'fecha_de_pedido' => 'required|unique:fecha_de_pedidos,fecha_de_pedido,'.$this->fecha_de_pedido_id,
            'fecha_de_llegada' => 'required|unique:fecha_de_pedidos,fecha_de_llegada,'.$this->fecha_de_pedido_id
        ];
    }

    public function mount(){
        $this->open = false;
        $this->fecha_de_pedido_id = 0;
        $this->fecha_de_apertura = "";
        $this->fecha_de_cierre = "";
        $this->fecha_de_pedido = "";
        $this->fecha_de_llegada = "";
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open','fecha_de_pedido_id');
        }
    }

    public function abrirModal($id){
        if($id > 0){
            $fecha_de_pedido = FechaDePedido::find($id);
            $this->fecha_de_apertura = $fecha_de_pedido->fecha_de_apertura;
            $this->fecha_de_cierre = $fecha_de_pedido->fecha_de_cierre;
            $this->fecha_de_pedido = $fecha_de_pedido->fecha_de_pedido;
            $this->fecha_de_llegada = $fecha_de_pedido->fecha_de_llegada;
        }
        $this->fecha_de_pedido_id = $id;
        $this->open = true;
    }

    public function registrar(){
        $this->validate();
        if($this->fecha_de_pedido_id > 0){
            $fecha_de_pedido = FechaDePedido::find($this->fecha_de_pedido_id);
            $fecha_de_pedido->fecha_de_apertura = $this->fecha_de_apertura;
            $fecha_de_pedido->fecha_de_pedido = $this->fecha_de_pedido;
            $fecha_de_pedido->fecha_de_cierre = $this->fecha_de_cierre;
            $fecha_de_pedido->fecha_de_llegada = $this->fecha_de_llegada;
            $fecha_de_pedido->save();
            $this->emit('alerta',['center','success','Fecha de pedido editada']);
        }else{
            FechaDePedido::create([
                'fecha_de_apertura' => $this->fecha_de_apertura,
                'fecha_de_cierre' => $this->fecha_de_cierre,
                'fecha_de_pedido' => $this->fecha_de_llegada,
                'fecha_de_llegada' => $this->fecha_de_pedido,
            ]);
            $this->emit('alerta',['center','success','Fecha de pedido registrada']);
        }
        $this->resetExcept('fecha_de_pedido_id');
        $this->emitTo('planificador.importar-datos.fecha-pedido.tabla','render');
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.fecha-pedido.modal');
    }
}
