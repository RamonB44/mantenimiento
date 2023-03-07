<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramacionDeTractor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Tractorista(){
        return $this->belongsTo(User::class,'tractorista');
    }

    public function Labor(){
        return $this->belongsTo(Labor::class);
    }

    public function Tractor(){
        return $this->belongsTo(Tractor::class);
    }

    public function Implementos(){
        return $this->hasMany(ImplementoProgramacion::class);
    }

    public function Lote(){
        return $this->belongsTo(Lote::class);
    }

    public function Supervisor(){
        return $this->belongsTo(User::class,'supervisor');
    }

    public function Solicitante(){
        return $this->belongsTo(User::class,'solicitante');
    }

    public function ReporteDeTractor(){
        return $this->hasOne(ReporteDeTractor::class);
    }
    public function ImplementoProgramacion(){
        return $this->hasMany(ImplementoProgramacion::class);
    }
}
