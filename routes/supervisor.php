<?php
    use App\Http\Livewire\Supervisor\ProgramacionDeTractores;
use App\Http\Livewire\Supervisor\ValidarRutinario;
use Illuminate\Support\Facades\Route;

    Route::get('/',ProgramacionDeTractores::class)->name('supervisor.programacion-de-tractores');
    Route::get('validar-rutinarios',ValidarRutinario::class)->name('supervisor.validar-rutinarios');
