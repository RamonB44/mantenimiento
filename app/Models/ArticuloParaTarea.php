<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloParaTarea extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Articulo(){
    	return $this->belongsTo(Articulo::class);
    }

    public function Tarea(){
    	return $this->belongsTo(Tarea::class);
    }
}
