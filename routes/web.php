<?php

use App\Http\Controllers\BorrowingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BorrowingController::class, 'index'])
    ->name('borrowing.index');

Route::get('/pinjam/{equipment}', [BorrowingController::class, 'create'])
    ->name('borrowings.create');

Route::post('/pinjam/{equipment}', [BorrowingController::class, 'store'])
    ->name('borrowings.store');
