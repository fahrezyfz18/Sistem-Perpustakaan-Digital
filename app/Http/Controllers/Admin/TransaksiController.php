<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Book;
use App\Models\Setting;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'book']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($user) use ($search) {
                    $user->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('book', function ($book) use ($search) {
                    $book->where('judul', 'like', "%{$search}%");
                });
            });
        }

        $transaksi = $query->latest()->paginate(8)->withQueryString();

        return view('pages.admin.transaksi.index', compact('transaksi'));
    }

    /**
     * TAMPILKAN FORM SIRKULASI BARU (PEMINJAMAN)
     */
    public function create()
    {
        // Ambil semua buku yang stoknya masih tersedia
        $books = Book::where('stok', '>', 0)->orderBy('judul')->get();
        
        // Ambil semua pengguna dengan role 'user' (Anggota)
        $users = User::where('role', 'user')->orderBy('name')->get();

        return view('pages.admin.transaksi.create', compact('books', 'users'));
    }

    /**
     * PROSES PENYIMPANAN TRANSAKSI SIRKULASI BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ], [
            'user_id.required' => 'Nama anggota wajib dipilih.',
            'book_id.required' => 'Judul buku wajib dipilih.',
        ]);

        $book = Book::findOrFail($request->book_id);

        // 1. Validasi Stok Fisik Buku
        if ($book->stok <= 0) {
            return back()->withInput()->with('error', 'Stok fisik buku ini sudah habis di rak.');
        }

        // 2. Validasi Duplikasi Peminjaman Aktif
        $alreadyBorrowed = Peminjaman::where('user_id', $request->user_id)
            ->where('book_id', $request->book_id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($alreadyBorrowed) {
            return back()->withInput()->with('error', 'Anggota ini masih meminjam buku yang sama dan belum dikembalikan.');
        }

        // 3. Ambil Konfigurasi Batas Hari Peminjaman Perpustakaan
        $setting = Setting::first();
        $batasHari = $setting->batas_hari ?? 7;

        // 4. Buat Transaksi Sirkulasi Baru
        Peminjaman::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'tanggal_pinjam' => now(),
            'tgl_jatuh_tempo' => now()->addDays($batasHari),
            'status' => 'dipinjam',
            'denda' => 0,
        ]);

        // 5. Kurangi Stok Fisik Buku Terkait
        $book->decrement('stok');

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi sirkulasi peminjaman berhasil dicatat.');
    }

    public function show($id)
    {
        $data = Peminjaman::with(['user', 'book'])->findOrFail($id);

        return view('pages.admin.transaksi.detail', compact('data'));
    }
}