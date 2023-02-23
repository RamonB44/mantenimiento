<?php

namespace App\Http\Livewire\Planificador\ValidarSolicitudDeArticulo;

use App\Models\SolicitudDePedido;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Operarios extends Component
{
    public $fecha_de_pedido;
    public $sede_id;
    public $operarios_pendientes;
    public $operarios_validados;

    protected $listeners = ['cambiarSede'];

    public function mount($fecha_de_pedido,$sede_id){
        $this->fecha_de_pedido = $fecha_de_pedido;
        $this->sede_id = $sede_id;
        if($this->sede_id > 0){
            $this->operarios_pendientes = $this->listar_operarios('CERRADO');
            $this->operarios_validados = $this->listar_operarios('VALIDADO');
        }else{
            $this->operarios_pendientes = new User();
            $this->operarios_validados = new User();
        }
    }

    public function cambiarSede($id){
        $this->sede_id = $id;
        if($this->sede_id > 0){
            $this->operarios_pendientes = $this->listar_operarios('CERRADO');
            $this->operarios_validados = $this->listar_operarios('VALIDADO');
        }else{
            $this->operarios_pendientes = new SolicitudDePedido();
            $this->operarios_validados = new SolicitudDePedido();
        }
    }

    public function listar_operarios($estado){
        if($estado == 'CERRADO'){
            $operarios = User::whereHas('SolicitudDePedido',function($q){
                            $q->where('sede_id',Auth::user()->sede_id)->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('estado','CERRADO');
                        })->get();
        }else{
            $operarios = User::whereHas('SolicitudDePedido',function($q){
                            $q->where('sede_id',Auth::user()->sede_id)->where('fecha_de_pedido_id',$this->fecha_de_pedido)->where('estado','VALIDADO');
                        })->get();
        }
        return $operarios;
    }

    public function render()
    {
        return view('livewire.planificador.validar-solicitud-de-articulo.operarios');
    }
}
