<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function UnidadDeMedida(){
        return $this->belongsTo(UnidadDeMedida::class);
    }

    public function Tarea(){
        return $this->hasMany(Tarea::class);
    }

    public function PiezaPorModelo(){
        return $this->hasMany(PiezaPorModelo::class,'pieza','id');
    }

    public function ComponentePorModelo(){
        return $this->hasMany(ComponentePorModelo::class,'articulo_id','id');
    }

    public function StockSede(){
        return $this->hasMany(StockSede::class);
    }

    public function StockOperario(){
        return $this->hasMany(StockOperario::class);
    }

    public function DetalleDeSolicitudDePedido(){
        return $this->hasMany(DetalleDeSolicitudDePedido::class);
    }
}
