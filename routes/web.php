<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TagihanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

// routes/web.php
Route::middleware('auth')->group(function () {
    // Kamar Routes
    Route::resource('/kamar', KamarController::class);
    
    // Laporan Routes
    Route::resource('/laporan', LaporanController::class);
    
    // Tagihan Routes
    Route::get('/tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
    
    // Payment Routes
    Route::prefix('payments')->group(function () {
        Route::get('/{tagihan}/checkout', [PaymentController::class, 'checkout'])->name('payments.checkout');
        Route::post('/{tagihan}/pay', [PaymentController::class, 'pay'])->name('payments.pay');
        Route::get('/{payment}/receipt', [PaymentController::class, 'receipt'])->name('payments.receipt');
    });
});