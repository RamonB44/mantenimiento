<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fundos(){
        return $this->hasMany(Fundo::class);
    }

    public function CentroDeCosto(){
        return $this->hasMany(CentroDeCosto::class);
    }

    public function User(){
        return $this->hasMany(User::class);
    }
}
