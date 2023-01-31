<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Implemento extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Sede(){
        return $this->belongsTo(Sede::class);
    }

    public function Responsable(){
        return $this->belongsTo(User::class,'responsable');
    }

    public function CentroDeCosto(){
        return $this->belongsTo(CentroDeCosto::class,);
    }

    public function ModeloDelImplemento(){
        return $this->belongsTo(ModeloDelImplemento::class);
    }
}
