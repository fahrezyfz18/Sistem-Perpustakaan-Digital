<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORM PENGEMBALIAN
    |--------------------------------------------------------------------------
    */

    public function create($id)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA PEMINJAMAN
        |--------------------------------------------------------------------------
        */

        $book = Peminjaman::with('book')
            ->where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN HALAMAN FORM
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.user.mybooks.return',
            compact('book')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES PENGEMBALIAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, $id)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA PEMINJAMAN
        |--------------------------------------------------------------------------
        */

        $peminjaman = Peminjaman::with('book')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | CEK STATUS
        |--------------------------------------------------------------------------
        */

        if ($peminjaman->status == 'dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        /*
        |--------------------------------------------------------------------------
        | HITUNG DENDA (INI POSISI YANG BENAR)
        |--------------------------------------------------------------------------
        */

        $today = now();
        $deadline = $peminjaman->deadline;

        $denda = 0;

        if ($today->gt($deadline)) {
            $selisihHari = $today->diffInDays($deadline);
            $denda = $selisihHari * 1000;
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS
        |--------------------------------------------------------------------------
        */

        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => $today,
            'kondisi' => $request->kondisi,
            'catatan' => $request->catatan,
            'denda' => $denda,
        ]);

        /*
        |--------------------------------------------------------------------------
        | TAMBAH STOK BUKU
        |--------------------------------------------------------------------------
        */

        if ($peminjaman->book) {
            $peminjaman->book->increment('stok');
        }

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('user.my-books.index')
            ->with('success', 'Buku berhasil dikembalikan.');
    }
} 