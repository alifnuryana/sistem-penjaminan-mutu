<?php

use App\Http\Controllers\DataUnitController;
use App\Http\Controllers\DecreeController;
use App\Http\Controllers\MultipleDeleteUnitController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', RouteServiceProvider::HOME);

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('data')->as('data.')->group(function () {
        Route::delete('units/destroys', MultipleDeleteUnitController::class)->name('units.destroys');
        Route::resource('units', DataUnitController::class)->only('index', 'create', 'store');
    });

    Route::get('decrees/index', [DecreeController::class, 'index'])->name('decrees.index');
    Route::get('decrees/detail', [DecreeController::class, 'detail'])->name('decrees.detail');
    Route::get('decrees/file/{path}', [DecreeController::class, 'showFile'])->name('decrees.file');
});
