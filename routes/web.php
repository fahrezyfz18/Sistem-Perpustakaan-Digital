<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\AnggotaController;

/*
|--------------------------------------------------------------------------
| USER CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\HistoryController;
use App\Http\Controllers\User\MyBookController;
use App\Http\Controllers\User\ProfileController as UserProfileController;

/*
|--------------------------------------------------------------------------
| GENERAL CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;

/*
|--------------------------------------------------------------------------
| MODELS
|--------------------------------------------------------------------------
*/

use App\Models\Peminjaman;


/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('home'))
    ->name('home');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [AuthenticatedSessionController::class, 'create']
)
    ->name('login');

Route::post(
    '/login',
    [AuthenticatedSessionController::class, 'store']
);

Route::post(
    '/logout',
    [AuthenticatedSessionController::class, 'destroy']
)
    ->name('logout');


Route::get(
    '/register',
    [RegisteredUserController::class, 'create']
)
    ->name('register');

Route::post(
    '/register',
    [RegisteredUserController::class, 'store']
);


/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if (!auth()->check()) {

        return redirect()->route('login');
    }

    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})
    ->middleware(['auth'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [AdminDashboardController::class, 'index']
        )
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | MASTER DATA
        |--------------------------------------------------------------------------
        */

        Route::resource('/buku', BookController::class);

        Route::resource('/anggota', AnggotaController::class);

        Route::resource('/kategori', CategoryController::class);

        Route::resource('/transaksi', TransaksiController::class);


        /*
        |--------------------------------------------------------------------------
        | PENGEMBALIAN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/pengembalian',
            [PengembalianController::class, 'index']
        )
            ->name('pengembalian.index');


        /*
        |--------------------------------------------------------------------------
        | LAPORAN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/laporan',
            [LaporanController::class, 'index']
        )->name('laporan.index');

        Route::get(
            '/laporan/export',
            [LaporanController::class, 'export']
        )
            ->name('laporan.export');


        /*
        |--------------------------------------------------------------------------
        | PROFILE
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/profile',
            [AdminProfileController::class, 'index']
        )
            ->name('profile.index');

        Route::get(
            '/profile/edit',
            [AdminProfileController::class, 'edit']
        )
            ->name('profile.edit');

        Route::patch(
            '/profile',
            [AdminProfileController::class, 'update']
        )
            ->name('profile.update');


        /*
        |--------------------------------------------------------------------------
        | SETTINGS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/settings',
            [SettingController::class, 'index']
        )
            ->name('settings.index');

        Route::get(
            '/settings/edit',
            [SettingController::class, 'edit']
        )
            ->name('settings.edit');

        Route::post(
            '/settings/update',
            [SettingController::class, 'update']
        )
            ->name('settings.update');


        /*
        |--------------------------------------------------------------------------
        | TEST PDF
        |--------------------------------------------------------------------------
        */

        Route::get('/test-pdf', function () {

            $data = Peminjaman::all();

            return view(
                'pages.admin.laporan.pdf',
                compact('data')
            );
        });
    });


/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isUser'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/profile', [UserProfileController::class, 'show'])
            ->name('profile.show');

        Route::get('/profile/edit', [UserProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::patch('/profile', [UserProfileController::class, 'update'])
            ->name('profile.update');


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [UserDashboardController::class, 'index']
        )
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | BOOKS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/books',
            [UserBookController::class, 'index']
        )
            ->name('books.index');

        Route::get(
            '/books/{book}',
            [UserBookController::class, 'show']
        )
            ->name('books.show');

        Route::get(
            '/books/filter',
            [UserBookController::class, 'filter']
        )
            ->name('books.filter');


        /*
        |--------------------------------------------------------------------------
        | HISTORY
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/history',
            [HistoryController::class, 'index']
        )
            ->name('history.index');


        /*
        |--------------------------------------------------------------------------
        | MY BOOKS
        |--------------------------------------------------------------------------
        */
        Route::get(
            '/my-books',
            [MyBookController::class, 'index']
        )
            ->name('my-books.index');


        Route::get(
            '/my-books/{id}/detail',
            [MyBookController::class, 'detail']
        )
            ->name('my-books.detail');


        Route::get(
            '/my-books/{id}/return',
            [PengembalianController::class, 'create']
        )
            ->name('my-books.return.form');


        Route::post(
            '/my-books/{id}/return',
            [PengembalianController::class, 'store']
        )
            ->name('my-books.return');


        /*
        |--------------------------------------------------------------------------
        | BORROW BOOK
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/borrow/{book}',
            [PeminjamanController::class, 'store']
        )
            ->name('borrow.store');

        Route::get(
            '/borrow/status',
            [PeminjamanController::class, 'status']
        )
            ->name('borrow.status');

        Route::get(
            '/borrow/{book}/create',
            [PeminjamanController::class, 'create']
        )->name('borrow.create');
        /*
        |--------------------------------------------------------------------------
        | USER PROFILE
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/borrow/{book}',
            [PeminjamanController::class, 'store']
        )
            ->name('borrow.store');

        Route::get(
            '/borrow/status',
            [PeminjamanController::class, 'status']
        )
            ->name('borrow.status');

        Route::get(
            '/borrow/{book}/create',
            [PeminjamanController::class, 'create']
        )
            ->name('borrow.create');
    });
