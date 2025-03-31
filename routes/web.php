<?php

use App\Http\Controllers\CivilizationController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('home');

Route::get('/leaders', [LeaderController::class, 'index'])->name('leaders');
Route::get('/leaders/{id}', [LeaderController::class, 'show'])->name('leaders.show');

Route::get('/civilizations', [CivilizationController::class, 'index'])->name('civilizations');
Route::get('/civilizations/{id}', [CivilizationController::class, 'show'])->name('civilizations.show');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
