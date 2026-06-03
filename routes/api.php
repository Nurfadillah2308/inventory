<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->middleware('role:admin');
    Route::delete('items/{item}', [ItemController::class, 'destroy'])->middleware('role:admin');

    Route::apiResource('categories', CategoryController::class)->except(['destroy']);
    Route::apiResource('items', ItemController::class)->except(['destroy']);
});