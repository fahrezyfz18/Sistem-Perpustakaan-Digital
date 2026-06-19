<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\Setting;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function store(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        if ($book->stok <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        $alreadyBorrowed = Peminjaman::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($alreadyBorrowed) {
            return back()->with('error', 'Anda sudah meminjam buku ini.');
        }

        $setting = Setting::first();

        $batasHari = $setting->batas_hari ?? 7;

        Peminjaman::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'tanggal_pinjam' => now(),
            'deadline' => now()->addDays($batasHari),
            'status' => 'dipinjam',
            'denda' => 0,
        ]);

        $book->decrement('stok');

        return redirect()
            ->route('user.my-books.index')
            ->with('success', 'Buku berhasil dipinjam.');
    }

    public function create(Book $book)
    {
        if (Peminjaman::isAlreadyBorrowed(auth()->id(), $book->id)) {
            return redirect()
                ->route('user.books.show', $book->id)
                ->with('error', 'Kamu sudah meminjam buku ini.');
        }

        return view('pages.user.books.borrow', compact('book'));
    }
}