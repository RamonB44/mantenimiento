<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutinario extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Tarea(){
        return $this->belognsTo(Tarea::class);
    }

    public function ProgramacioDeTractor(){
        return $this->belognsTo(ProgramacioDeTractor::class);
    }

    public function Operario(){
        return $this->belongsTo(User::class,'operario','id');
    }
}
