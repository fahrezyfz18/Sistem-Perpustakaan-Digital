<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function create($id)
    {
        $book = Peminjaman::with('book')
            ->where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return view(
            'pages.user.mybooks.return',
            compact('book')
        );
    }

public function store(Request $request, $id)
{
    $peminjaman = Peminjaman::with('book')
        ->where('user_id', auth()->id())
        ->findOrFail($id);

    if ($peminjaman->status == 'dikembalikan') {
        return back()->with('error', 'Buku sudah dikembalikan.');
    }

    $today = now();
    $denda = 0;

    if (
        $peminjaman->tgl_jatuh_tempo &&
        $today->gt($peminjaman->tgl_jatuh_tempo)
    ) {
        $hariTelat = $peminjaman->tgl_jatuh_tempo
            ->startOfDay()
            ->diffInDays($today->startOfDay());

        $denda = $hariTelat * 2000;
    }

    $peminjaman->update([
        'status' => 'dikembalikan',
        'tanggal_dikembalikan' => $today,
        'denda' => $denda,
    ]);

    if ($peminjaman->book) {
        $peminjaman->book->increment('stok');
    }

    return redirect()
        ->route('user.my-books.index')
        ->with('success', 'Buku berhasil dikembalikan.');
}