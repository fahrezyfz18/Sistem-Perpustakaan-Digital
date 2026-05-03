<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\TransaksiController;

// PUBLIC
Route::get('/', fn() => view('home'))->name('home');

// =====================
// AUTH
// =====================

// LOGIN
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// REGISTER
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);


// =====================
// DASHBOARD REDIRECT
// =====================
Route::get('/dashboard', function () {

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');

})->middleware(['auth'])->name('dashboard');


// =====================
// ADMIN
// =====================
Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('/buku', BookController::class);

        Route::resource('/anggota', AnggotaController::class);

        Route::resource('/transaksi', TransaksiController::class);

        Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');

        // ✅ LAPORAN
        Route::get('/laporan-peminjaman', [LaporanController::class, 'index'])
            ->name('laporan.peminjaman');

        // 🔥 TAMBAHAN EXPORT (INI YANG KAMU BUTUH)
        Route::get('/laporan/export', [LaporanController::class, 'export'])
            ->name('laporan.export');
    });


// =====================
// USER
// =====================
Route::middleware(['auth', 'isUser'])
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

// 🔥 TEST PDF (TAMBAHAN)    
use App\Models\Peminjaman;

Route::get('/test-pdf', function () {
    $data = Peminjaman::all();
    return view('pages.admin.laporan.pdf', compact('data'));
});

require __DIR__ . '/auth.php';