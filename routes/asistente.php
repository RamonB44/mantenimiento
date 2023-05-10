<?php

use App\Http\Livewire\Asistente\ProgramacionDeTractores\Base;
use App\Http\Livewire\Asistente\ReporteDeTractores;
use App\Http\Livewire\Asistente\ReporteHoraxImplemento;
use App\Http\Livewire\Asistente\ReporteTractorxSolicitante;
use Illuminate\Support\Facades\Route;

Route::get('/', Base::class)->name('asistente.programacion-de-tractores');
Route::get('/reporte', ReporteDeTractores::class)->name('asistente.reporte-de-tractores');
