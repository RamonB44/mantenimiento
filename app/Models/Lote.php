<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Fundo(){
        return $this->belongsTo(Fundo::class);
    }

    public function EncargadoModel(){
        return $this->belongsTo(User::class,'encargado');
    }

    public function Cultivo(){
        return $this->belongsTo(Cultivo::class);
    }
}
