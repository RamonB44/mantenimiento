<?php

use App\Http\Livewire\Jefe\ProgramacionCultivo\Base as ProgramacionCultivoBase;
use App\Http\Livewire\Jefe\ProgramacionDeTractores\Base as ProgramacionDeTractores;
use App\Http\Livewire\Jefe\ReporteDeTractores\Base as ReporteDeTractoresBase;
use App\Http\Livewire\Jefe\ReporteHoraxImplemento;
use App\Http\Livewire\Jefe\ReporteTractorxSolicitante;
use Illuminate\Support\Facades\Route;

    Route::get('/reporte/tractor-x-solicitante',ReporteTractorxSolicitante::class)->name('jefe.reporte-tractor-x-solicitante');
    Route::get('/reporte/hora-x-implementos',ReporteHoraxImplemento::class)->name('jefe.reporte-hora-x-implementos');

    Route::get('/',ProgramacionCultivoBase::class)->name('jefe.programacion-por-cultivo');
    Route::get('/Programacion',ProgramacionDeTractores::class)->name('jefe.programacion-de-tractores');
    Route::get('/Reporte',ReporteDeTractoresBase::class)->name('jefe.reporte-de-tractores');

