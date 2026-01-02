<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/app', [InventoryController::class, 'index'])->name('app');
Route::post('/analyze', [InventoryController::class, 'analyze'])->name('analyze');