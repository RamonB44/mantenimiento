<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tractor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ModeloDeTractor(){
        return $this->belongsTo(ModeloDeTractor::class);
    }

    public function Sede(){
        return $this->belongsTo(Sede::class);
    }

    public function ProgramacionDeTractor(){
        return $this->hasMany(ProgramacionDeTractor::class);
    }
}
