<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloDeTractor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Tractor(){
        return $this->hasMany(Tractor::class);
    }
}
