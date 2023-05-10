<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentesParaMantenimiento extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function modelo(){
        return $this->morphTo();
    }
}
