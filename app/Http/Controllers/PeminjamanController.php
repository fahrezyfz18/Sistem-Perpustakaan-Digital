<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\Setting;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Book $book)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI STOK
        |--------------------------------------------------------------------------
        */

        if ($book->stok <= 0) {

            return back()->with(
                'error',
                'Stok buku habis.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CEK SUDAH MEMINJAM?
        |--------------------------------------------------------------------------
        */

        $alreadyBorrowed = Peminjaman::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($alreadyBorrowed) {

            return back()->with(
                'error',
                'Anda sudah meminjam buku ini.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL SETTING BATAS HARI
        |--------------------------------------------------------------------------
        */

        $setting = Setting::first();

        $batasHari = $setting->batas_hari ?? 7;

        /*
        |--------------------------------------------------------------------------
        | SIMPAN PEMINJAMAN
        |--------------------------------------------------------------------------
        */

        Peminjaman::create([

            'user_id' => auth()->id(),

            'book_id' => $book->id,

            'tanggal_pinjam' => now(),

            'tanggal_kembali' => now()->addDays($batasHari),

            'status' => 'dipinjam',

        ]);

        /*
        |--------------------------------------------------------------------------
        | KURANGI STOK
        |--------------------------------------------------------------------------
        */

        $book->decrement('stok');

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('user.my-books.index')
            ->with(
                'success',
                'Buku berhasil dipinjam.'
            );
    }
}