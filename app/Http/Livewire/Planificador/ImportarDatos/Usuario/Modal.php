<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Usuario;

use App\Models\Sede;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class Modal extends Component
{
    public $open;
    public $sede_id;
    public $sedes;
    public $usuario_id;
    public $codigo;
    public $dni;
    public $nombre;
    public $roles_id;
    public $roles;
    public $is_active;

    protected $listeners = ['abrirModal','obtenerUsuario'];

    protected function rules(){
        return [
            'sede_id' => 'required|exists:sedes,id',
            'codigo' => 'required|unique:users,codigo,'.$this->usuario_id,
            'dni' => 'required|unique:users,dni,'.$this->usuario_id,
            'nombre' => 'required',
        ];
    }

    protected function messages(){
        return [
            'sede_id.required' => 'La sede es requerida',
            'sede_id.exists' => 'Seleccione la sede'
        ];
    }

    public function mount(){
        $this->open = false;
        $this->sede_id = 0;
        $this->sedes = Sede::all();
        $this->codigo = "";
        $this->dni = "";
        $this->nombre = "";
        $this->roles_id = [];
        $this->roles = Role::all();
        $this->is_active = 1;
    }

    public function obtenerUsuario($id) {
        $this->usuario_id = $id;
    }

    public function abrirModal($id){
        if($id > 0){
            $usuario = User::find($this->usuario_id);
            $this->sede_id = $usuario->sede_id;
            $this->codigo = $usuario->codigo;
            $this->dni = $usuario->dni;
            $this->nombre = $usuario->name;
            $this->roles_id = [];
            foreach($usuario->roles as $rol){
                if(!in_array($rol->id,$this->roles_id)){
                    array_push($this->roles_id,$rol->id);
                }
            }
            $this->is_active = $usuario->is_active;
            $this->emit('obtenerSelectRoles',$this->roles_id);
        }
        $this->open = true;
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open','sedes','usuario_id','roles');
            $this->is_active = 1;
            $this->emit('reestablecerSelectRoles');
            $this->resetValidation();
        }
    }

    public function registrar() {
        $this->validate();
        if($this->usuario_id > 0){
            $usuario = User::find($this->usuario_id);
            $usuario->codigo = $this->codigo;
            $usuario->dni = $this->dni;
            $usuario->name = strtoupper($this->nombre);
            $usuario->is_active = $this->is_active;
            $usuario->save();
            $this->emit('alerta',['center','success','Usuario editado']);
        }else{
            $usuario = User::create([
                'codigo' => $this->codigo,
                'dni' => $this->dni,
                'name' => strtoupper($this->nombre),
                'email' => null,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'is_admin' => false,
                'sede_id' => $this->sede_id,
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,
            ]);
            $this->emit('alerta',['center','success','Usuario editado']);
        }
        $this->resetExcept('sedes','usuario_id','roles');
        $this->emitTo('planificador.importar-datos.usuarios.tabla','render');
    }

    public function render()
    {
        $this->emit('estiloSelect2');
        return view('livewire.planificador.importar-datos.usuario.modal');
    }
}
