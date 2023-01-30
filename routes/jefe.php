<?php
    use App\Http\Livewire\Jefe\Dashboard;
    use Illuminate\Support\Facades\Route;

    Route::get('/',Dashboard::class)->name('jefe.dashboard');
