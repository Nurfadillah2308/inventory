<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;

// Bungkus semua route dengan prefix v1
Route::prefix('v1')->group(function () {

    // Public Routes (Register & Login)
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Protected Routes (Harus menggunakan token)
    Route::middleware('auth:sanctum')->group(function () {
        
        // Resource Route untuk Items dan Categories
        Route::apiResource('items', ItemController::class);
        Route::apiResource('categories', CategoryController::class);
        
    });
});