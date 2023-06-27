<?php

use App\Http\Controllers\AccreditationController;
use App\Http\Controllers\DataIndexController;
use App\Http\Controllers\DataUnitController;
use App\Http\Controllers\DetailDecreeController;
use App\Http\Controllers\IndexDecreeController;
use App\Http\Controllers\MultipleDeleteAccreditationController;
use App\Http\Controllers\MultipleDeleteUnitController;
use App\Http\Controllers\SendUnitRemainderController;
use App\Http\Controllers\ShowFileDecreeController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', RouteServiceProvider::HOME);

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('accreditations', AccreditationController::class)->only('index', 'create', 'store');
    Route::delete('accreditations/destroys', MultipleDeleteAccreditationController::class)->name('accreditations.destroys');

    Route::prefix('data')->as('data.')->group(function () {
        Route::get('/', DataIndexController::class)->name('index');
        Route::resource('units', DataUnitController::class)->only('index', 'create', 'store', 'show', 'edit', 'update');
        Route::delete('units/destroys', MultipleDeleteUnitController::class)->name('units.destroys');
        Route::post('/units/{unit}/sendRemainder/{notification}', SendUnitRemainderController::class)->name('units.sendRemainder');
        Route::get('/decrees', IndexDecreeController::class)->name('decrees.index');
        Route::get('/decrees/detail', DetailDecreeController::class)->name('decrees.detail');
        Route::get('/decress/file/{path}', ShowFileDecreeController::class)->name('decrees.file');
    });
});
