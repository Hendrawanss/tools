<?php

use App\Http\Controllers\Calculator\AsymmetricSignatureController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('calculator')->name('calculator.')->group(function () {
    Route::get('/asymmetric', [AsymmetricSignatureController::class, 'index'])->name('asymmetric.index');
    Route::post('/asymmetric', [AsymmetricSignatureController::class, 'generate'])->name('asymmetric.generate');
});
