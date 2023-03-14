<?php
use App\Http\Livewire\Jefe\ProgramacionDeTractores\Base;
use App\Http\Livewire\Jefe\ReporteDeTractores\Base as ReporteDeTractoresBase;
use Illuminate\Support\Facades\Route;

    Route::get('/',Base::class)->name('jefe.programacion-de-tractores');
    Route::get('/Reporte',ReporteDeTractoresBase::class)->name('jefe.reporte-de-tractores');
