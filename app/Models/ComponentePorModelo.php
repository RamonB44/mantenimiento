<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentePorModelo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Modelo(){
        return $this->belongsTo(ModeloDelImplemento::class,'modelo_id','id');
    }
    public function Articulo(){
    	return $this->belongsTo(Articulo::class);
    }

    public function Sistema() {
        return $this->belongsTo(Sistema::class);
    }
}
