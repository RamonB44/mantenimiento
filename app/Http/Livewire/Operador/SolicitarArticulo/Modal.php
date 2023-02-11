<?php

namespace App\Http\Livewire\Operador\SolicitarArticulo;

use App\Models\Articulo;
use App\Models\ComponentePorModelo;
use App\Models\DetalleDeSolicitudDePedido;
use App\Models\FechaDePedido;
use App\Models\Implemento;
use App\Models\SolicitudDePedido;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $tipo;
    public $implemento_id;
    public $articulo;
    public $componente;
    public $cantidad;
    public $precio;

    protected $listeners = ['cambiar_implemento','abrir_modal'];

    public function mount(){
        $this->open = false;
        $this->implemento_id = 0;
        $this->tipo = "";
        $this->articulo = 0;
        $this->componente = 0;
        $this->cantidad = 1;
        $this->precio = 0;
    }

    public function cambiar_implemento($id){
        $this->implemento_id = $id;
    }

    public function abrir_modal($tipo){
        $this->tipo = $tipo;
        $this->open = true;
    }

    public function updatedArticulo(){
        if($this->articulo > 0){
            $this->precio = Articulo::find($this->articulo)->precio_estimado;
        }
    }

    public function registrar(){
        if(FechaDePedido::whereDate('fecha_de_apertura','<=',Carbon::today())->whereDate('fecha_de_cierre','>=',Carbon::today())->exists()){
            $fecha_de_pedido = FechaDePedido::whereDate('fecha_de_apertura','<=',Carbon::today())->whereDate('fecha_de_cierre','>=',Carbon::today())->select('id')->first();
            $solicitud_de_pedido = SolicitudDePedido::firstOrCreate([
                'solicitante' => Auth::user()->id,
                'implemento_id' => $this->implemento_id,
                'fecha_de_pedido_id' => $fecha_de_pedido->id
            ]);

            DetalleDeSolicitudDePedido::updateOrCreate(
                [
                    'solicitud_de_pedido_id' => $solicitud_de_pedido->id,
                    'articulo_id' => $this->articulo,
                ],
                [
                    'cantidad' => $this->cantidad,
                    'estimated_price' => $this->precio,
                    'estado' => 'ACEPTADO'
                ]
            );

            $this->emit('alerta',['center','success','Agregado correctamente']);

            $this->emitTo('operador.solicitar-articulo.tabla','render');
        }
    }

    public function render()
    {
        if($this->implemento_id > 0){
            if($this->tipo == "componente"){
                $articulos = Articulo::whereHas('ComponentePorModelo',function($q){
                    $q->where('modelo_id',Implemento::find($this->implemento_id)->modelo_del_implemento_id);
                })->get();
            }else if($this->tipo == "pieza"){
                $modelo_id = Implemento::find($this->implemento_id)->modelo_del_implemento_id;
                $componentes = ComponentePorModelo::where('modelo_id',$modelo_id)->get();
                if($this->componente > 0){
                    $articulos = Articulo::whereHas('PiezaPorModelo',function($q){
                        $q->where('articulo_id',$this->componente);
                    })->get();
                }else{
                    $articulos = [];
                }
                
            }else{
                $articulos = Articulo::where('tipo',strtoupper($this->tipo))->get();
            }
            if($this->tipo != "pieza"){
                $componentes = [];
            }
        }else{
            $articulos = [];
            $componentes = [];
        }

        return view('livewire.operador.solicitar-articulo.modal',compact('articulos','componentes'));
    }
}
