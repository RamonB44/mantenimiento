<?php

use App\Http\Livewire\Planificador\HorasImplemento\Base as HorasImplementoBase;
use App\Http\Livewire\Planificador\ImportarDatos\Base as ImportarDatosBase;
use App\Http\Livewire\Planificador\IngresoArticulos\Base as IngresoArticulosBase;
use App\Http\Livewire\Planificador\Stock\Base as StockBase;
use App\Http\Livewire\Planificador\ValidarSolicitudDeArticulos;
use App\Http\Livewire\Planificador\ImportarDatosImplementos\Base as ImportarInfoImplementosBase;
use Illuminate\Support\Facades\Route;

    Route::get('/',ValidarSolicitudDeArticulos::class)->name('planificador.validar-solicitud-de-articulos');
    Route::get('/horas-implementos',HorasImplementoBase::class)->name('planificador.horas-implementos');
    Route::get('/stock',StockBase::class)->name('planificador.stock');
    Route::get('/ingreso-articulos',IngresoArticulosBase::class)->name('planificador.ingreso-articulos');
    Route::get('/importar-datos',ImportarDatosBase::class)->name('planificador.importar-datos');
    Route::get('/importar-info-implementos',ImportarInfoImplementosBase::class)->name('planificador.importar-info-implementos');
