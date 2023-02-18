<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Rutinario;

use App\Imports\RutinariosImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Importar extends Component
{
    use WithFileUploads;

    public $open;
    public $archivo;

    protected $listeners = ['abrir_modal'];

    public function mount()
    {
        $this->open = false;
    }

    public function rules(){
        return [
            'archivo' => 'required|file'
        ];
    }

    public function abrir_modal(){
        $this->open = true;
    }

    public function importar(){
        $this->validate();
        try {
            Excel::import(new RutinariosImport, $this->archivo);
            $this->emit('alerta',['center','success','Archivo Importado']);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $errores = $e->failures();
            $this->emit('alerta',['center','warning',$errores[0]->errors()]);
        }
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.rutinario.importar');
    }
}
