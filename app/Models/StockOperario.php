<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOperario extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Articulo(){
        return $this->belongsTo(Articulo::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Sede(){
        return $this->belongsTo(Sede::class);
    }
}
