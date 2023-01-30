<?php

use App\Http\Livewire\Planificador\ValidarSolicitudDeArticulos;
use Illuminate\Support\Facades\Route;

    Route::get('/',ValidarSolicitudDeArticulos::class)->name('planificador.validar-solicitud-de-articulos');
