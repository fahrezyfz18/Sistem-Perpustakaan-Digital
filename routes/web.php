<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Admin Area Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\AnggotaController;

// User Area Controllers
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\MyBookController;
use App\Http\Controllers\User\ProfileController as UserProfileController;

// General Feature Controllers
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Models\Peminjaman;

/* --- PUBLIC --- */
Route::get('/', [HomeController::class, 'index'])->name('home');

/* --- AUTH SYSTEM --- */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth');

/* --- CENTRAL DASHBOARD REDIRECT --- */
Route::get('/dashboard', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->middleware(['auth'])->name('dashboard');

/* --- ADMIN AREA (GUARDED) --- */
Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Master Data Resources
        Route::resource('/buku', BookController::class);
        Route::resource('/anggota', AnggotaController::class);
        Route::resource('/kategori', CategoryController::class);
        Route::resource('/transaksi', TransaksiController::class);

        // Return Process & Reports
        Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');

        // Admin Profile
        Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');

        // Site Settings (STANDAR RESTful)
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

        // PDF Testing Utility
        Route::get('/test-pdf', function () {
            $data = Peminjaman::all();
            return view('pages.admin.laporan.pdf', compact('data'));
        });
    });

/* --- USER AREA (GUARDED) --- */
Route::middleware(['auth', 'isUser'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');

        Route::get('/books', [UserBookController::class, 'index'])->name('books.index');
        Route::get('/books/filter', [UserBookController::class, 'filter'])->name('books.filter');
        Route::get('/books/{book}', [UserBookController::class, 'show'])->name('books.show');

        Route::get('/my-books', [MyBookController::class, 'index'])->name('my-books.index');
        Route::get('/my-books/{id}/detail', [MyBookController::class, 'detail'])->name('my-books.detail');
        Route::get('/my-books/{id}/return', [PengembalianController::class, 'create'])->name('my-books.return.form');
        Route::post('/my-books/{id}/return', [PengembalianController::class, 'store'])->name('my-books.return');

        Route::get('/borrow/status', [PeminjamanController::class, 'status'])->name('borrow.status');
        Route::get('/borrow/{book}/create', [PeminjamanController::class, 'create'])->name('borrow.create');
        Route::post('/borrow/{book}', [PeminjamanController::class, 'store'])->name('borrow.store');
    });