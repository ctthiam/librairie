<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/books/archived', [BookController::class, 'archived'])->name('books.archived');
    Route::post('/books/{book}/archive', [BookController::class, 'archive'])->name('books.archive');
    Route::post('/books/{book}/unarchive', [BookController::class, 'unarchive'])->name('books.unarchive');
    Route::resource('books', BookController::class);
    Route::get('/catalog', [OrderController::class, 'catalog'])->name('orders.catalog');
    Route::post('/catalog/add', [OrderController::class, 'addToCart'])->name('orders.addToCart');
    Route::get('/catalog/{book}', [OrderController::class, 'showBook'])->name('orders.book');
    Route::resource('orders', OrderController::class)->except(['create', 'edit']);
    Route::match(['get', 'post'], '/orders/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay');
});

require __DIR__.'/auth.php';
