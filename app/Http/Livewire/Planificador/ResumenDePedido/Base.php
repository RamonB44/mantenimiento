<?php

namespace App\Http\Livewire\Planificador\ResumenDePedido;

use App\Models\CentroDeCosto;
use Livewire\Component;

class Base extends Component
{
    public function render()
    {
        return view('livewire.planificador.resumen-de-pedido.base');
    }
}
