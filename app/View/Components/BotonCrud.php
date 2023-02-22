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
    public $colspan;
    public $colspansm;
    public $padding;

    public function __construct(string $accion = null, string $color = null,bool $activo = true, int $colspan = 1, int $colspansm = 1,$padding = 4)
    {
        $this->accion = $accion;
        $this->color = $color;
        $this->activo = $activo;
        if($colspan < 1 || $colspan > 6){
            $this->colspan = 1;
        }else{
            $this->colspan = $colspan;
        }
        $this->colspansm = $colspansm;
        $this->padding = $padding;
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
