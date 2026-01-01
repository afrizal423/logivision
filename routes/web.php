<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

Route::get('/', [InventoryController::class, 'index']);
Route::post('/analyze', [InventoryController::class, 'analyze'])->name('analyze');