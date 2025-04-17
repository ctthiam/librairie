<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/books/archived', [BookController::class, 'archived'])->name('books.archived');
Route::post('/books/{book}/archive', [BookController::class, 'archive'])->name('books.archive');
Route::post('/books/{book}/unarchive', [BookController::class, 'unarchive'])->name('books.unarchive');
Route::resource('books', BookController::class); // Déplacé après
Route::get('/catalog', [OrderController::class, 'catalog'])->name('orders.catalog');
Route::post('/catalog/add', [OrderController::class, 'addToCart'])->name('orders.addToCart');
Route::resource('orders', OrderController::class)->except(['create', 'edit']);
Route::get('/catalog/{book}', [OrderController::class, 'showBook'])->name('orders.book');