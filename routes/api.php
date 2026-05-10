<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

// Otomatis membuat route untuk GET, POST, PUT, dan DELETE
Route::apiResource('categories', CategoryController::class);
Route::apiResource('items', ItemController::class);