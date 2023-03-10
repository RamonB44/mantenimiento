<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentePorImplemento extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ComponentesParaMantenimiento(){
        return $this->morphMany(ComponentesParaMantenimiento::class,'modelo');
    }
    public function Articulo(){
        return $this->belongsTo(Articulo::class);
    }
}
