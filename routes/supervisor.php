<?php
    use App\Http\Livewire\Supervisor\ProgramacionDeTractores;
    use Illuminate\Support\Facades\Route;

    Route::get('/',ProgramacionDeTractores::class)->name('supervisor.programacion-de-tractores');
