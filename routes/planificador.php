<?php

use App\Http\Livewire\Planificador\HorasImplemento\Base as HorasImplementoBase;
use App\Http\Livewire\Planificador\ImportarDatos\Base;
use App\Http\Livewire\Planificador\ValidarSolicitudDeArticulos;
use Illuminate\Support\Facades\Route;

    Route::get('/',ValidarSolicitudDeArticulos::class)->name('planificador.validar-solicitud-de-articulos');
    Route::get('/importar-datos',Base::class)->name('planificador.importar-datos');
    Route::get('/horas-implementos',HorasImplementoBase::class)->name('planificador.horas-implementos');
