<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImplementoProgramacion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ProgramacionDeTractor(){
        return $this->belongsTo(ProgramacionDeTractor::class);
    }

    public function Implemento(){
        return $this->belongsTo(Implemento::class);
    }

    public function Rutinarios(){
        return $this->belongsTo(Rutinario::class,'id','implemento_programacion_id');
    }

    public function Supervisor(){
        return $this->belongsTo(User::class,'supervisor','id');
    }

    public function Operario(){
        return $this->belongsTo(User::class,'operario','id');
    }
}
