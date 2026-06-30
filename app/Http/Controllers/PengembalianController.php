<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    /**
     * Menampilkan daftar pengembalian (Admin).
     */
    public function index()
    {
        $pengembalian = Pengembalian::with('peminjaman.book', 'peminjaman.user')
            ->latest()
            ->get();

        return view('pages.admin.pengembalian.index', compact('pengembalian'));
    }

    /**
     * Menampilkan form pengembalian.
     */
    public function create($id)
    {
        $book = Peminjaman::with('book')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->firstOrFail();

        return view('pages.user.mybooks.return', compact('book'));
    }

    /**
     * Memproses pengembalian buku.
     */
    public function store(Request $request, $id)
    {
        $peminjaman = Peminjaman::with('book')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->firstOrFail();

        $tanggalKembali = Carbon::today();

        // Hitung jumlah hari keterlambatan
        $terlambatHari = 0;

        if (
            $peminjaman->tgl_jatuh_tempo &&
            $tanggalKembali->gt($peminjaman->tgl_jatuh_tempo)
        ) {
            $terlambatHari = $peminjaman->tgl_jatuh_tempo
                ->diffInDays($tanggalKembali);
        }

        // Simpan data pengembalian
        Pengembalian::create([
            'id_peminjaman' => $peminjaman->id,
            'tgl_kembali' => $tanggalKembali,
            'terlambat_hari' => $terlambatHari,
        ]);

        // Update data peminjaman
        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => $tanggalKembali,
            'denda' => $terlambatHari * 2000,
        ]);

        // Tambahkan kembali stok buku
        if ($peminjaman->book) {
            $peminjaman->book->increment('stok');
        }
        
        return redirect()
            ->route('user.my-books.index')
            ->with('success', 'Buku berhasil dikembalikan.');
    }
}