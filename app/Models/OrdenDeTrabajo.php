<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenDeTrabajo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Tareas(){
        return $this->hasMany(TareaOrdenDeTrabajo::class);
    }

    public function Epps(){
        return $this->hasMany(EppOrdenDeTrabajo::class);
    }
}
