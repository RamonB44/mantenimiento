<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiezaPorModelo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Pieza(){
    	return $this->belongsTo(Articulo::class,'pieza','id');
    }

    public function Componente(){
    	return $this->belongsTo(Articulo::class,'articulo_id','id');
    }
}
