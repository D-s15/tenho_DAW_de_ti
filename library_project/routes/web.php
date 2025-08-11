<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', [BookController::class, 'index']);

Route::prefix('books')->name('books.')->controller(BookController::class)->group(function () {
    Route::get('welcome', 'index')->name('index');           // Lista todos os livros
    Route::get('/create', 'create')->name('create');   // Formulário de criação
    Route::post('/', 'store')->name('store');          // Armazena novo livro
    Route::get('/{book}', 'show')->name('show');       // Mostra um livro específico
    Route::get('/{book}/edit', 'edit')->name('edit');  // Formulário de edição
    Route::put('/{book}', 'update')->name('update');   // Atualiza livro
    Route::delete('/{book}', 'destroy')->name('destroy'); // Apaga livro
});