<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\Admin\BookController;

// PUBLIC
Route::get('/', fn() => view('home'))->name('home');

// AUTH
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// DASHBOARD REDIRECT
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth'])->name('dashboard');


// =====================
// ADMIN
// =====================
Route::middleware(['auth','isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/buku', BookController::class);
    Route::resource('/anggota', AnggotaController::class);

    //TRANSAKSI (gabungan peminjaman + pengembalian)
    Route::get('/transaksi', [LaporanController::class, 'index'])
        ->name('transaksi.index');

    Route::get('/transaksi/{id}', [LaporanController::class, 'show'])
        ->name('transaksi.detail');

    //LAPORAN
    Route::get('/laporan-peminjaman', [LaporanController::class, 'index'])
        ->name('laporan.peminjaman');

    //DETAIL
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])
        ->name('laporan.detail');
});


// =====================
// USER
// =====================
Route::middleware(['auth','isUser'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');

    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/filter', [BookController::class, 'filter'])->name('books.filter');

    Route::get('/borrow', [PeminjamanController::class, 'index'])->name('borrow.index');
    Route::get('/borrow/status', [PeminjamanController::class, 'status'])->name('borrow.status');
});


// =====================
// PROFILE
// =====================
Route::middleware('auth')
    ->prefix('profile')
    ->name('profile.')
    ->group(function () {

    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';