<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoArticulo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Articulo(){
        return $this->belongsTo(Articulo::class);
    }

    public function FechaDePedido(){
        return $this->belongsTo(FechaDePedido::class);
    }

    public function Planificador(){
        return $this->belongsTo(User::class,'planificador');
    }

    public function CentroDeCosto() {
        return $this->belongsTo(CentroDeCosto::class);
    }

    public function Sede(){
        return $this->belongsTo(Sede::class);
    }
}
