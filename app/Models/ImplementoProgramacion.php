<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImplementoProgramacion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ProgramacionDeTractor(){
        return $this->belongsTo(ProgramacionDeTractor::class);
    }

    public function Implemento(){
        return $this->belongsTo(Implemento::class);
    }
}
