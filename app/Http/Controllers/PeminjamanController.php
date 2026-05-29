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

    public function store(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        // VALIDASI
    $request->validate([
        'tanggal_pinjam' => 'required|date',
        'deadline' => 'required|date|after_or_equal:tanggal_pinjam',
    ]);

        // CEK STOK
        if ($book->stok <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        // CEK DOUBLE PINJAM
        $alreadyBorrowed = Peminjaman::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($alreadyBorrowed) {
            return back()->with('error', 'Anda sudah meminjam buku ini.');
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL SETTING BATAS HARI
        |--------------------------------------------------------------------------
        */

        $setting = Setting::first();

        $batasHari = $setting->batas_hari ?? 7;

        // SIMPAN PEMINJAMAN
        Peminjaman::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,

            'tanggal_pinjam' => now(),

            'tanggal_kembali' => now()->addDays(7),

            'status' => 'dipinjam',
        ]);

        // KURANGI STOK
        $book->decrement('stok');

        return redirect()
            ->route('user.my-books.index')
            ->with('success', 'Buku berhasil dipinjam.');
    }

    public function create(Book $book)
    {
        // anti double borrow
        if (Peminjaman::isAlreadyBorrowed(auth()->id(), $book->id)) {
            return redirect()->route('user.books.show', $book->id)
                ->with('error', 'Kamu sudah meminjam buku ini.');
        }

        return view('pages.user.books.borrow', compact('book'));
    }
}   