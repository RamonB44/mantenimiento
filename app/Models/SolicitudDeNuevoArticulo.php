<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudDeNuevoArticulo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function SolicitudDePedido(){
        return $this->belongsTo(SolicitudDePedido::class);
    }

    public function UnidadDeMedida(){
        return $this->belongsTo(UnidadDeMedida::class);
    }
}
