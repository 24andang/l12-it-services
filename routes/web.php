<?php

use App\Http\Middleware\Auth;
use App\Livewire\Config;
use App\Livewire\Dashboard;
use App\Livewire\Handover;
use App\Livewire\Login;
use App\Livewire\Stock;
use Illuminate\Support\Facades\Route;

Route::get('/login', Login::class)->name('login');

Route::get('/', function () {
    if (session()->has('initial')) {
        return redirect()->route('stock');
    }
    return redirect()->route('login');
});

Route::middleware(Auth::class)->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard'); //page bayangan
    Route::get('/stock', Stock::class)->name('stock');
    Route::get('/handover', Handover::class);
    Route::get('/handover-pdf/{id}', [Handover::class, 'exportPdf'])->name('handover.pdf');
    Route::get('/config', Config::class);
});
