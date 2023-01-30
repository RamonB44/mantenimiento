<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleDeSolicitudDePedido extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function SolicitudDePedido(){
        return $this->belongsTo(SolicitudDePedido::class);
    }

    public function Articulo(){
        return $this->belongsTo(Articulo::class);
    }
}
