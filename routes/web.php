<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardController; 

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


// ADMIN
Route::middleware(['auth','isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/buku', [BookController::class, 'tampilkan'])->name('buku.index');

    Route::resource('/anggota', AnggotaController::class);

    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');

    Route::get('/laporan', [LaporanController::class, 'peminjaman'])->name('laporan.peminjaman');
});


// USER (SATU GROUP SAJA)
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


// PROFILE
Route::middleware('auth')
    ->prefix('profile')
    ->name('profile.')
    ->group(function () {

    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';