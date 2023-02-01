<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloDelImplemento extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Implemento(){
        return $this->hasMany(Implemento::class);
    }

    public function ComponentePorModelo(){
        return $this->hasMany(ComponentePorModelo::class,'modelo_id','id');
    }
}
