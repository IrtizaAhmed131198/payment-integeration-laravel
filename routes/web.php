<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
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

    Route::get('/chat', function () {
        return view('chat');
    })->name('chat');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/store', [MessageController::class, 'store'])->name('messages.store');

    Route::get('/pay', [PaymentController::class, 'showForm'])->name('payment.form');
    Route::post('/pay', [PaymentController::class, 'makePayment'])->name('payment.make');
});

require __DIR__.'/auth.php';
