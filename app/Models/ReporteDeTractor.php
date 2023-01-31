<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteDeTractor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Tractorista(){
        return $this->belongsTo(User::class,'tractorista');
    }

    public function Tractor(){
        return $this->belongsTo(Tractor::class);
    }

    public function Labor(){
        return $this->belongsTo(Labor::class);
    }

    public function Implemento(){
        return $this->belongsTo(Implemento::class);
    }

    public function Lote(){
        return $this->belongsTo(Lote::class);
    }

    public function ValidadoPor(){
        return $this->belongsTo(User::class,'validado_por');
    }
}
