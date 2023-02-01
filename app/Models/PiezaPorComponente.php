<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiezaPorComponente extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Pieza(){
    	return $this->belongsTo(Articulo::class,'id','pieza')
    }

    public function Componente(){
    	return $this->belongsTo(Articulo::class,'id','articulo_id')
    }
}
