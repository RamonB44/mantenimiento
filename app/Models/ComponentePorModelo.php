<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentePorModelo extends Model
{
    use HasFactory;

    public function Modelo(){
        return $this->belongsTo(ModeloDelImplemento::class);
    }
    public function Articulo(){
    	return $this->belongsTo(Articulo::class);
    }
}
