<?php

    use App\Http\Livewire\Asistente\ReporteDeTractores;
    use Illuminate\Support\Facades\Route;

    Route::get('/',ReporteDeTractores::class)->name('asistente.reporte-de-tractores');
