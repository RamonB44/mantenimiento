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

    public function ImplementoProgramacion(){
        return $this->hasMany(ImplementoProgramacion::class);
    }
}
