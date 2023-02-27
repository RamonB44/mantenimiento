<?php

namespace App\Http\Livewire\Supervisor\ValidarRutinario;

use App\Models\ImplementoProgramacion;
use App\Models\ProgramacionDeTractor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    public $implemento;
    public $operario;
    public $fecha;
    public $turno;

    protected $listeners = ['render','filtrar'];

    public function mount(){
        $this->implemento = 0;
        $this->operario = 0;
        $this->fecha = "";
        $this->turno = "";
    }

    public function filtrar($fecha,$turno,$operario,$implemento){
        $this->resetPage();
        $this->fecha = $fecha;
        $this->turno = $turno;
        $this->operario = $operario;
        $this->implemento = $implemento;
    }

    public function render()
    {
        $rutinarios = ImplementoProgramacion::whereHas('ProgramacionDeTractor',function($q){
            $q->where('supervisor',Auth::user()->id)->where('esta_anulado',0);
            if($this->fecha != ""){
                $q = $q->whereHas('fecha',$this->fecha);
            }
            if($this->turno != ""){
                $q = $q->where('turno',$this->turno);
            }
        });

        if($this->operario > 0){
            $rutinarios = $rutinarios->whereHas('Rutinarios',function($q){
                $q->where('operario',$this->operario);
            });
        }else{
            $rutinarios = $rutinarios->has('Rutinarios');
        }

        if($this->implemento > 0){
            $rutinarios = $rutinarios->where('implemento_id',$this->implemento);
        }

        $rutinarios = $rutinarios->latest()->paginate(6);

        return view('livewire.supervisor.validar-rutinario.tabla',compact('rutinarios'));
    }
}
