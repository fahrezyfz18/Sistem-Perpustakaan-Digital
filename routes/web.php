<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Models\Peminjaman;

// =====================
// PUBLIC
// =====================
Route::get('/', fn() => view('home'))->name('home');


// =====================
// AUTH
// =====================
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);


// =====================
// DASHBOARD REDIRECT
// =====================
Route::get('/dashboard', function () {

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');

})->middleware(['auth'])->name('dashboard');


// =====================
// ADMIN AREA
// =====================
Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Master Data
        Route::resource('/buku', BookController::class);
        Route::resource('/anggota', AnggotaController::class);
        Route::resource('/transaksi', TransaksiController::class);

        // Pengembalian
        Route::get('/pengembalian', [PengembalianController::class, 'index'])
            ->name('pengembalian.index');

        // Laporan
        Route::get('/laporan-peminjaman', [LaporanController::class, 'index'])
            ->name('laporan.peminjaman');

        Route::get('/laporan/export', [LaporanController::class, 'export'])
            ->name('laporan.export');

        // Profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::get('/settings/edit', [SettingController::class, 'edit'])->name('settings.edit');

        // TEST PDF (debug)
        Route::get('/test-pdf', function () {
            $data = Peminjaman::all();
            return view('pages.admin.laporan.pdf', compact('data'));
        });
    });


// =====================
// USER AREA
// =====================
Route::middleware(['auth', 'isUser'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'userDashboard'])
            ->name('dashboard');

        Route::get('/books', [BookController::class, 'index'])
            ->name('books.index');

        Route::get('/books/filter', [BookController::class, 'filter'])
            ->name('books.filter');

        Route::get('/borrow', [PeminjamanController::class, 'index'])
            ->name('borrow.index');

        Route::get('/borrow/status', [PeminjamanController::class, 'status'])
            ->name('borrow.status');
    });


// =====================
// PROFILE USER GLOBAL
// =====================
Route::middleware('auth')
    ->prefix('profile')
    ->name('profile.')
    ->group(function () {

        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });