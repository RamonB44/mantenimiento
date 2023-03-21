<?php

use App\Http\Livewire\Jefe\ProgramacionCultivo\Base as ProgramacionCultivoBase;
use App\Http\Livewire\Jefe\ProgramacionDeTractores\Base;
use App\Http\Livewire\Jefe\ReporteDeTractores\Base as ReporteDeTractoresBase;
use Illuminate\Support\Facades\Route;

    Route::get('/',ProgramacionCultivoBase::class)->name('jefe.programacion-por-cultivo');
    Route::get('/Programacion',Base::class)->name('jefe.programacion-de-tractores');
    Route::get('/Reporte',ReporteDeTractoresBase::class)->name('jefe.reporte-de-tractores');
