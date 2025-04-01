<?php

use App\Http\Controllers\CivilizationController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Civilization;
use App\Models\Leader;

Route::get('/', function () {
    return Inertia::render('Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'isAuthenticated' => auth()->check(),
    ]);
})->name('home')->breadcrumb('Home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /**
     * Leader routes that require authentication
     */
    Route::get('/leaders/create', [LeaderController::class, 'create'])
        ->name('leaders.create')
        ->breadcrumb('Create Leader', 'leaders.index');
    Route::post('/leaders', [LeaderController::class, 'store'])
        ->name('leaders.store');
    Route::get('/leaders/{id}/edit', [LeaderController::class, 'edit'])
        ->name('leaders.edit')
        ->breadcrumb('Edit', 'leaders.show');
    Route::put('/leaders/{id}', [LeaderController::class, 'update'])
        ->name('leaders.update');
    Route::delete('/leaders/{id}', [LeaderController::class, 'delete'])
        ->name('leaders.delete');

    /**
     * Civilization routes that require authentication
     */
    Route::get('/civilizations/create', [CivilizationController::class, 'create'])
        ->name('civilizations.create')
        ->breadcrumb('Create Civilization', 'civilizations.index');
    Route::post('/civilizations', [CivilizationController::class, 'store'])
        ->name('civilizations.store');
    Route::get('/civilizations/{id}/edit', [CivilizationController::class, 'edit'])
        ->name('civilizations.edit')
        ->breadcrumb("Edit", 'civilizations.show');
    Route::put('/civilizations/{id}', [CivilizationController::class, 'update'])
        ->name('civilizations.update');
    Route::delete('/civilizations/{id}', [CivilizationController::class, 'delete'])
        ->name('civilizations.delete');
});

/**
 * Public leader routes
 */
Route::get('/leaders', [LeaderController::class, 'index'])
    ->name('leaders.index')
    ->breadcrumb('Leaders', 'home');
Route::get('/leaders/{id}', [LeaderController::class, 'show'])
    ->name('leaders.show')
    ->breadcrumb(fn(string $leaderId) => Leader::query()->find($leaderId)->getAttribute('name'), 'leaders.index');


/**
 * Public civilization routes
 */
Route::get('/civilizations', [CivilizationController::class, 'index'])
    ->name('civilizations.index')
    ->breadcrumb('Civilizations', 'home');
Route::get('/civilizations/{id}', [CivilizationController::class, 'show'])
    ->name('civilizations.show')
    ->breadcrumb(fn(string $civilizationId) => Civilization::query()->find($civilizationId)->getAttribute('name'), 'civilizations.index');



require __DIR__ . '/auth.php';
