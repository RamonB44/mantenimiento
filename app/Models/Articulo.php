<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function UnidadDeMedida(){
        return $this->belongsTo(UnidadDeMedida::class);
    }

    public function Tarea(){
        return $this->hasMany(Tarea::class);
    }
}
