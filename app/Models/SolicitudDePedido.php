<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudDePedido extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Solicitante(){
        return $this->belongsTo(User::class,'solicitante');
    }

    public function Implemento(){
        return $this->belongsTo(Implemento::class);
    }

    public function ValidadoPor(){
        return $this->belongsTo(User::class,'validado_por');
    }

    public function FechaDePedido(){
        return $this->belongsTo(FechaDePedido::class);
    }
    public function SolicitudDeNuevoArticulo(){
        return $this->hasMany(SolicitudDeNuevoArticulo::class);
    }
}
