<?php

namespace App\Http\Livewire\Operador\SolicitarArticuloNuevo;

use App\Models\SolicitudDeNuevoArticulo;
use App\Models\SolicitudDePedido;
use App\Models\UnidadDeMedida;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Modal extends Component
{
    use WithFileUploads;

    public $open;
    public $fecha_de_pedido;
    public $implemento_id;
    public $articulo;
    public $unidad_de_medida;
    public $cantidad;
    public $ficha_tecnica;
    public $imagen;
    public $imagen_antigua;
    public $unidades_medida;
    public $iteracion;
    public $material_nuevo;

    protected $listeners = ['abrir_modal','cambiar_implemento'];

    protected function rules(){
        return [
            'articulo' => 'required',
            'cantidad' => 'required|gt:0',
            'unidad_de_medida' => 'required|exists:unidad_de_medidas,id',
            'ficha_tecnica' => 'required',
            'imagen' => 'image',
        ];
    }

    public function mount($implemento_id,$fecha_de_pedido){
        $this->open = false;
        $this->fecha_de_pedido = $fecha_de_pedido;
        $this->implemento_id = $implemento_id;
        $this->articulo = "";
        $this->unidad_de_medida = 0;
        $this->cantidad = 1;
        $this->ficha_tecnica = "";
        $this->imagen = "";
        $this->imagen_antigua = "";
        $this->unidades_medida = UnidadDeMedida::all();
        $this->iteracion = 0;
    }

    public function cambiar_implemento($id){
        $this->implemento_id = $id;
    }

    public function udpatedImagen(){
        $nombre_de_imagen = $this->image->getClientOriginalName();
        if(!preg_match('/.jpg$/i',$nombre_de_imagen)
        && !preg_match('/.jpeg$/i',$nombre_de_imagen)
        && !preg_match('/.png$/i',$nombre_de_imagen)
        && !preg_match('/.gif$/i',$nombre_de_imagen)
        && !preg_match('/.jfif$/i',$nombre_de_imagen)
        && !preg_match('/.svg$/i',$nombre_de_imagen)){
            $this->imagen = "";
            $this->iteracion++;
        }
        $this->resetValidation('imagen');
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->reset('articulo','cantidad','unidad_de_medida','ficha_tecnica','imagen','imagen_antigua','material_nuevo');
            $this->resetValidation();
            $this->iteracion++;
        }
    }

    public function abrir_modal($id){
        $this->material_nuevo = $id;
        if($id > 0){
            $solicitud_de_material_nuevo = SolicitudDeNuevoArticulo::find($id);
            $this->articulo = $solicitud_de_material_nuevo->nuevo_articulo;
            $this->cantidad = $solicitud_de_material_nuevo->cantidad;
            $this->unidad_de_medida = $solicitud_de_material_nuevo->unidad_de_medida_id;
            $this->ficha_tecnica = $solicitud_de_material_nuevo->ficha_tecnica;
            $this->imagen_antigua = Storage::url($solicitud_de_material_nuevo->imagen);
        }
        $this->open = true;
    }

    public function registrar(){

        $solicitud_de_pedido = SolicitudDePedido::firstOrCreate([
            'solicitante' => Auth::user()->id,
            'implemento_id' => $this->implemento_id,
            'fecha_de_pedido_id' => $this->fecha_de_pedido
        ]);

        if($this->imagen != ""){
            $imagen = $this->imagen->store('public/materiales_nuevos');
        }

        if($this->material_nuevo > 0){
            $solicitud_de_material_nuevo = SolicitudDeNuevoArticulo::find($this->material_nuevo);
            $solicitud_de_material_nuevo->nuevo_articulo = $this->articulo;
            $solicitud_de_material_nuevo->cantidad = $this->cantidad;
            $solicitud_de_material_nuevo->unidad_de_medida_id = $this->unidad_de_medida;
            $solicitud_de_material_nuevo->ficha_tecnica = $this->ficha_tecnica;
            if($this->imagen != ""){
                Storage::delete($solicitud_de_material_nuevo->imagen);
                $solicitud_de_material_nuevo->imagen = $imagen;
            }
            $solicitud_de_material_nuevo->save();
        }else{
            SolicitudDeNuevoArticulo::create([
                'solicitud_de_pedido_id' => $solicitud_de_pedido->id,
                'nuevo_articulo' => $this->articulo,
                'cantidad' => $this->cantidad,
                'unidad_de_medida_id' => $this->unidad_de_medida,
                'ficha_tecnica' => $this->ficha_tecnica,
                'imagen' => substr($imagen,7),
            ]);
        }
        $this->resetExcept('fecha_de_pedido','implemento_id','iteracion','unidades_medida');
        $this->emitTo('operador.solicitar-articulo-nuevo.tabla','cambiar_implemento',$this->implemento_id);
        $this->emit('alerta',['center','success','Operación Exitosa']);
        $this->iteracion++;
    }

    public function render()
    {

        return view('livewire.operador.solicitar-articulo-nuevo.modal');
    }
}
