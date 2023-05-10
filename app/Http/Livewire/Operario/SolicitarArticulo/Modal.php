<?php

namespace App\Http\Livewire\Operario\SolicitarArticulo;

use App\Models\Articulo;
use App\Models\ComponentePorModelo;
use App\Models\DetalleDeSolicitudDePedido;
use App\Models\Implemento;
use App\Models\SolicitudDePedido;
use App\Models\StockOperario;
use App\Models\StockSede;
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
    public $unidad_de_medida;
    public $fecha_de_pedido;
    public $detalle_de_solicitud;
    public $articulo_name;

    protected $listeners = ['cambiarImplemento','abrirModal'];

    public function mount($implemento_id,$fecha_de_pedido){
        $this->open = false;
        $this->implemento_id = $implemento_id;
        $this->tipo = "";
        $this->articulo = 0;
        $this->componente = 0;
        $this->cantidad = 1;
        $this->precio = 0;
        $this->unidad_de_medida = "";
        $this->fecha_de_pedido = $fecha_de_pedido;
        $this->detalle_de_solicitud = 0;
        $this->articulo_name = "";
    }

    public function cambiarImplemento($id){
        $this->implemento_id = $id;
    }

    public function abrirModal($tipo,$detalle_de_solicitud=0){
        $this->tipo = $tipo;
        $this->open = true;
        $this->detalle_de_solicitud = $detalle_de_solicitud;
    }

    public function updatedComponente(){
        $this->reset('articulo','precio','unidad_de_medida');
    }

    public function updatedArticulo(){
        if($this->articulo > 0){
            $modelo_articulo = Articulo::find($this->articulo);
            $this->precio = $modelo_articulo->precio_estimado;
            $this->unidad_de_medida = $modelo_articulo->UnidadDeMedida->unidad_de_medida;
        }else{
            $this->reset('precio','unidad_de_medida');
        }
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open','implemento_id','existe_pedido','fecha_de_pedido');
        }
    }

    public function registrar(){
        if($this->articulo > 0 && $this->cantidad > 0){
            $solicitud_de_pedido = SolicitudDePedido::firstOrCreate([
                'solicitante' => Auth::user()->id,
                'implemento_id' => $this->implemento_id,
                'fecha_de_pedido_id' => $this->fecha_de_pedido,
                'sede_id' => Auth::user()->sede_id,
            ]);

            DetalleDeSolicitudDePedido::updateOrCreate(
                [
                    'solicitud_de_pedido_id' => $solicitud_de_pedido->id,
                    'articulo_id' => $this->articulo,
                ],
                [
                    'cantidad_solicitada' => $this->cantidad,
                    'precio' => $this->precio,
                ]
            );

            $this->emit('alerta',['center','success','Agregado correctamente']);
            $this->resetExcept('open','implemento_id','existe_pedido','fecha_de_pedido');
            $this->emitTo('operario.solicitar-articulo.cabecera','obtenerMontos');
            $this->emitTo('operario.solicitar-articulo.tabla','render');
        }else{
            $this->emit('alerta',['center','error','Faltan datos']);
        }
    }

    public function render()
    {
        //Inicializando variables
        $articulos = [];
        $componentes = [];
        $stock = 0;
        $en_proceso = 0;
        if($this->implemento_id > 0){
            if(SolicitudDePedido::where('solicitante',Auth::user()->id)->where('implemento_id',$this->implemento_id)->where('fecha_de_pedido_id',$this->fecha_de_pedido)->exists()){
                if($this->tipo == "editar"){
                    $detalle = DetalleDeSolicitudDePedido::find($this->detalle_de_solicitud);
                    $this->articulo = $detalle->articulo_id;
                    $this->articulo_name = strtoupper($detalle->Articulo->articulo);
                    $this->cantidad = $detalle->cantidad_solicitada;
                    $this->precio = $detalle->Articulo->precio_estimado;
                }else if($this->tipo == "componente"){
                    $articulos = Articulo::whereDoesntHave('DetalleDeSolicitudDePedido',function ($q){
                        $q->where('solicitud_de_pedido_id',SolicitudDePedido::where('solicitante',Auth::user()->id)->where('implemento_id',$this->implemento_id)->where('fecha_de_pedido_id',$this->fecha_de_pedido)->first()->id);
                    })->whereHas('ComponentePorModelo',function($q){
                        $q->where('modelo_id',Implemento::find($this->implemento_id)->modelo_del_implemento_id);
                    })->get();
                }else if($this->tipo == "pieza"){
                    $modelo_id = Implemento::find($this->implemento_id)->modelo_del_implemento_id;
                    $componentes = ComponentePorModelo::where('modelo_id',$modelo_id)->get();
                    if($this->componente > 0){
                        $articulos = Articulo::whereDoesntHave('DetalleDeSolicitudDePedido', function($q){
                            $q->where('solicitud_de_pedido_id',SolicitudDePedido::where('solicitante',Auth::user()->id)->where('implemento_id',$this->implemento_id)->where('fecha_de_pedido_id',$this->fecha_de_pedido)->first()->id);
                        })->whereHas('PiezaPorModelo',function($q){
                            $q->where('articulo_id',$this->componente);
                        })->get();
                    }
                }else{
                    $articulos = Articulo::whereDoesnthave('DetalleDeSolicitudDePedido',function($q){
                        $q->where('solicitud_de_pedido_id',SolicitudDePedido::where('solicitante',Auth::user()->id)->where('implemento_id',$this->implemento_id)->where('fecha_de_pedido_id',$this->fecha_de_pedido)->first()->id);
                    })->where('tipo',strtoupper($this->tipo))->get();
                }
            }else{
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
                    }
                }else{
                    $articulos = Articulo::where('tipo',strtoupper($this->tipo))->get();
                }
            }

            if($this->articulo > 0){
                if(StockOperario::where('user_id',Auth::user()->id)->where('articulo_id',$this->articulo)->exists()){
                    $stock = StockOperario::where('user_id',Auth::user()->id)->where('articulo_id',$this->articulo)->first()->cantidad;
                }
                if(StockSede::where('sede_id',Auth::user()->sede_id)->where('articulo_id',$this->articulo)->exists()){
                    $en_proceso = StockSede::where('sede_id',Auth::user()->sede_id)->where('articulo_id',$this->articulo)->first()->cantidad;
                }
            }
        }

        return view('livewire.operario.solicitar-articulo.modal',compact('articulos','componentes','en_proceso','stock'));
    }
}
