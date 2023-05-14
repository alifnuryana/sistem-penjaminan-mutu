<?php

use App\Http\Controllers\AccreditationController;
use App\Http\Controllers\DataUnitController;
use App\Http\Controllers\MultipleDeleteAccreditationController;
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

    Route::resource('accreditations', AccreditationController::class)->only('index', 'create', 'store');
    Route::delete('accreditations/destroys', MultipleDeleteAccreditationController::class)->name('accreditations.destroys');

    Route::prefix('data')->as('data.')->group(function () {
        Route::delete('units/destroys', MultipleDeleteUnitController::class)->name('units.destroys');
        Route::resource('units', DataUnitController::class)->only('index', 'create', 'store');
    });
});
