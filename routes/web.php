<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BorrowRecordController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Book routes
    Route::resource('books', BookController::class);
    
    // Author routes
    Route::resource('authors', AuthorController::class);
    
    // Borrow record routes
    Route::resource('borrow-records', BorrowRecordController::class);
    Route::post('borrow-records/{borrowRecord}/return', [BorrowRecordController::class, 'return'])->name('borrow-records.return');
});