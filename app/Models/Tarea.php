<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ArticuloParaTarea(){
    	return $this->hasMany(ArticuloParaTarea::class,'tarea_id','id');
    }

    public function Articulo(){
        return $this->belongsTo(Articulo::class);
    }
}
