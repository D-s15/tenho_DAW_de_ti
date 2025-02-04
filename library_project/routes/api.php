<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController; 
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Api\LocalApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/books', [BookController::class, 'index']);
Route::get('/fetch-books', [LocalApiController::class, 'getBooksData']);
Route::get('/categories', [CategoryController::class, 'getCategories']);