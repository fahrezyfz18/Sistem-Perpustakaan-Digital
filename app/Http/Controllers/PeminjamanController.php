<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function store(Book $book)
    {
        // cek stok
        if ($book->stok <= 0) {

            return back()->with('error', 'Stok buku habis');

        }

        // simpan peminjaman
        Peminjaman::create([

            'user_id' => auth()->id(),

            'book_id' => $book->id,

            'tanggal_pinjam' => now(),

            'tanggal_kembali' => now()->addDays(7),

            'status' => 'dipinjam',

        ]);

        // kurangi stok
        $book->decrement('stok');

        return redirect()
            ->route('user.my-books.index')
            ->with('success', 'Buku berhasil dipinjam');
    }
}