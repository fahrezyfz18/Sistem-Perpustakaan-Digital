<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
<<<<<<< HEAD
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
=======
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AnggotaController;
>>>>>>> ce46655c79ff61edd5ed3d6459051e9dd1f54606


// PUBLIC
Route::get('/', fn() => view('home'));


// AUTH
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

<<<<<<< HEAD
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
=======
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
>>>>>>> ce46655c79ff61edd5ed3d6459051e9dd1f54606

// ADMIN
Route::middleware(['auth','isAdmin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    Route::get('/buku', [BookController::class, 'tampilkan'])->name('buku.index');

    Route::resource('/anggota', AnggotaController::class);

    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');

    Route::get('/laporan', [LaporanController::class, 'peminjaman'])->name('laporan.peminjaman');
});


// USER
Route::middleware(['auth','isUser'])->prefix('user')->name('user.')->group(function () {

    Route::get('/dashboard', fn() => view('user.dashboard'))->name('dashboard');
});
// FITUR USER
Route::middleware(['auth','isUser'])->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/filter', [BookController::class, 'filter'])->name('books.filter');

    Route::get('/borrow', [PeminjamanController::class, 'index'])->name('borrow.index');
    Route::get('/borrow/status', [PeminjamanController::class, 'status'])->name('borrow.status');
});


// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';