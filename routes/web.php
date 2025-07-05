<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\TicketController;
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



// Dashboard sebagai tampilan utama (hanya untuk user login)
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Daftar event/konser untuk beli tiket
    Route::get('/concerts', [\App\Http\Controllers\ConcertListController::class, 'index'])->name('concerts.list');

    // My Tiket Ku (riwayat transaksi user)
    Route::get('/mytickets', [\App\Http\Controllers\MyTicketController::class, 'index'])->name('mytickets');

    // Tiketku (My Tickets) 
    Route::get('/mytickets/{id}', [App\Http\Controllers\MyTicketController::class, 'show']);

    // Form pemesanan tiket
    Route::get('/ticket/form/{concert}', [\App\Http\Controllers\OrderTicketController::class, 'showForm'])->name('ticket.form');
    Route::post('/ticket/order/{concert}', [\App\Http\Controllers\OrderTicketController::class, 'order'])->name('ticket.order');
    Route::post('/payment/process/{method}/{trx}', [\App\Http\Controllers\OrderTicketController::class, 'processPayment'])->name('payment.process');
});

// Route legacy pembelian tiket (sudah tidak dipakai)
// Route::post('/concerts/{concert}/buy', [\App\Http\Controllers\TicketPurchaseController::class, 'store'])->name('concerts.buy')->middleware('auth');
Route::resource("/pesanan", PesananController::class);

require __DIR__ . '/auth.php';
require __DIR__.'/admin.php';