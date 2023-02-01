<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BotonCrud extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $accion;
    public $color;
    public $activo;

    public function __construct(string $accion = null, string $color = null,bool $activo = true)
    {
        $this->accion = $accion;
        $this->color = $color;
        $this->activo = $activo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.boton-crud');
    }
}
