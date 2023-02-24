<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaOrdenDeTrabajo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function OrdenDeTrabajo(){
        return $this->belongsTo(OrdenDeTrabajo::class);
    }
}
