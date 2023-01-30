<?php

use App\Http\Livewire\Operador\SolicitarArticulos;
use Illuminate\Support\Facades\Route;

    Route::get('/',SolicitarArticulos::class)->name('operador.solicitar-articulos');
