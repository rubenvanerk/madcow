<?php

use App\Http\Livewire\RepMaxes;
use App\Http\Livewire\Workout;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/workout/{workout}', Workout::class)->name('workout');
    Route::get('/rep-maxes', RepMaxes::class)->name('rep-maxes');

});

require __DIR__.'/auth.php';
