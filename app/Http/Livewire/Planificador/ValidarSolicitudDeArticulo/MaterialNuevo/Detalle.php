<?php

namespace App\Http\Livewire\Planificador\ValidarSolicitudDeArticulo\MaterialNuevo;

use App\Models\Articulo;
use App\Models\DetalleDeSolicitudDePedido;
use App\Models\SolicitudDeNuevoArticulo;
use App\Models\UnidadDeMedida;
use Livewire\Component;

class Detalle extends Component
{
    public $open;
    public $solicitud_id;

    public $cantidad_solicitada;
    public $um;
    public $ficha_tecnica;
    public $codigo;
    public $articulo;
    public $tipo;
    public $unidad_de_medida_id;
    public $imagen;
    public $precio;
    public $cantidad;
    public $unidades_de_medida;
    public $solicitud_nuevo_id;

    protected $listeners = ['abrirModal'];

    protected function rules(){
        return [
            'codigo' => 'required|unique:articulos,codigo',
            'articulo' => 'required|unique:articulos,articulo',
            'unidad_de_medida_id' => 'required|exists:unidad_de_medidas,id',
            'precio' => 'required|min:1',
            'tipo' => 'required',
        ];
    }

    public function mount(){
        $this->open = false;
        $this->solicitud_id = 0;
        $this->cantidad_solicitada = 0;
        $this->solicitud_nuevo_id = 0;
        $this->um = "";
        $this->ficha_tecnica = "";
        $this->codigo = "";
        $this->articulo = "";
        $this->tipo = "";
        $this->unidad_de_medida_id = 0;
        $this->imagen = "";
        $this->precio = 0;
        $this->cantidad = 1;
        $this->unidades_de_medida = UnidadDeMedida::all();
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open','unidades_de_medida');
        }
    }

    public function abrirModal($id){
        $solicitud = SolicitudDeNuevoArticulo::find($id);
        $this->solicitud_nuevo_id = $id;
        $this->solicitud_id = $solicitud->solicitud_de_pedido_id;
        $this->cantidad_solicitada = $solicitud->cantidad;
        $this->um = $solicitud->UnidadDeMedida->unidad_de_medida;
        $this->ficha_tecnica = $solicitud->ficha_tecnica;
        $this->articulo = $solicitud->nuevo_articulo;
        $this->unidad_de_medida_id = $solicitud->unidad_de_medida_id;
        $this->imagen = "/storage/".$solicitud->imagen;
        $this->cantidad = $solicitud->cantidad;
        $this->open = true;
    }

    public function registrar() {
        $this->validate();
        $nuevo_articulo = Articulo::create([
            'codigo' => $this->codigo,
            'articulo' => strtoupper($this->articulo),
            'unidad_de_medida_id' => $this->unidad_de_medida_id,
            'precio_estimado' => $this->precio,
            'tipo' => $this->tipo,
        ]);
        DetalleDeSolicitudDePedido::create([
            'solicitud_de_pedido_id' => $this->solicitud_id,
            'articulo_id' => $nuevo_articulo->id,
            'cantidad_solicitada' => $this->cantidad_solicitada,
            'cantidad_validada' => $this->cantidad,
            'precio' => $this->precio,
            'estado' => 'VALIDADO',
        ]);

        $solicitud_nuevo = SolicitudDeNuevoArticulo::find($this->solicitud_nuevo_id);
        $solicitud_nuevo->estado = 'CREADO';
        $solicitud_nuevo->save();

        $this->resetExcept('unidades_de_medida');
        $this->emitTo('planificador.validar-solicitud-de-articulo.material-nuevo.modal','render');
        $this->emitTo('planificador.validar-solicitud-de-articulo.modal','obtenerDatos');
        $this->emitTo('planificador.validar-solicitud-de-articulo.material-nuevo.base','cambiarSolicitud',$this->solicitud_id);
        $this->emit('alerta',['center','success','Material Agregado']);
    }

    public function rechazar(){
        $solicitud_nuevo = SolicitudDeNuevoArticulo::find($this->solicitud_nuevo_id);
        $solicitud_nuevo->estado = 'RECHAZADO';
        $solicitud_nuevo->save();
        $this->resetExcept('unidades_de_medida');
        $this->emitTo('planificador.validar-solicitud-de-articulo.material-nuevo.modal','render');
        $this->emitTo('planificador.validar-solicitud-de-articulo.modal','obtenerDatos');
        $this->emitTo('planificador.validar-solicitud-de-articulo.material-nuevo.base','cambiarSolicitud',$this->solicitud_id);
        $this->emit('alerta',['center','success','Material Rechazado']);
    }

    public function render()
    {
        return view('livewire.planificador.validar-solicitud-de-articulo.material-nuevo.detalle');
    }
}
