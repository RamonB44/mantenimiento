<?php

use App\Http\Livewire\Operario\SolicitarArticulos;
use Illuminate\Support\Facades\Route;

    Route::get('/',SolicitarArticulos::class)->name('operario.solicitar-articulos');
