<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleMontoCeco extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function CentroDeCosto(){
        return $this->belongsTo(CentroDeCosto::class);
    }
}
