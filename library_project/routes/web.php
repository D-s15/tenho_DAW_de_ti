<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::prefix('books')->name('books.')->group(function () {
    Route::get('/show/{isbn}', [BookController::class, 'show'])->name('show'); // Exibir detalhes de um curso específico
    Route::get('/store/{isbn}', [BookController::class, 'store'])->name('store');
});