<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('items', ItemController::class);
Route::apiResource('categories', CategoryController::class);