<?php

namespace App\Http\Livewire\Planificador\HorasImplemento;

use App\Models\ComponentePorImplemento;
use App\Models\Implemento;
use App\Models\PiezaPorComponente;
use App\Models\Sede;
use App\Models\User;
use Livewire\Component;

class Base extends Component
{
    public $sede_id;
    public $sedes;
    public $operario_id;
    public $operarios;
    public $componentes;
    public $piezas;
    public $implement;

    protected $listeners = ['mostrarComponentes', 'mostrarPiezas'];

    public function mount()
    {
        $this->sede_id = 0;
        $this->operario_id = 0;
        $this->sedes = Sede::all();
        $this->operarios = [];
        $this->componentes = [];
        // $this->piezas = [];
    }

    public function updatedSedeId()
    {
        if ($this->sede_id > 0) {
            $this->operarios = User::has('Implementos')->where('sede_id', $this->sede_id)->get();
        } else {
            $this->operarios = [];
        }
    }

    public function mostrarComponentes($implemento_id)
    {
        // dd($implemento_id);
        $this->implement = Implemento::find($implemento_id);
        $this->componentes = ComponentePorImplemento::where('implemento_id',$implemento_id)->get();
        $this->emit('showOffCanvas');
    }

    public function render()
    {
        $implementos = Implemento::where('responsable', $this->operario_id)->get();
        // $componentes = ComponentePorImplemento::get();
        // $piezas = PiezaPorComponente::get();
        return view('livewire.planificador.horas-implemento.base', compact('implementos'));
    }
}
