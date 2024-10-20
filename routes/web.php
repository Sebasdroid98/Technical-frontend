<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ BooksController::class, 'index'])->name('home');

Route::controller(BooksController::class)->group(function () {
    Route::get('list-books', 'listBooks')->name('list-books');
    Route::get('info-book/{id}', 'show')->name('info-book');
    Route::post('store-book', 'store')->name('store-book');
    Route::put('update-book/{id}', 'update')->name('update-book');
    Route::delete('delete-book/{id}', 'destroy')->name('delete-book');
});
