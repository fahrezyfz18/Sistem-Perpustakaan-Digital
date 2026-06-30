<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama untuk user.
     */
    public function index()
    {
        $userId = Auth::id();

        // 1. Data Statistik (Dashboard Cards)
        $totalPinjam = Peminjaman::where('user_id', $userId)->count();
        $dipinjam    = Peminjaman::where('user_id', $userId)->where('status', 'dipinjam')->count();
        $selesai     = Peminjaman::where('user_id', $userId)->where('status', 'dikembalikan')->count();
        
        // Menghitung total denda dari transaksi user
        $totalDenda  = Peminjaman::where('user_id', $userId)->sum('denda');

        // 2. Data Rekomendasi Buku (Buku terbaru)
        $rekomendasi = Book::latest()->take(3)->get();

        // 3. Data Peringatan Jatuh Tempo (H-3 hari)
        // Menggunakan kolom 'tgl_jatuh_tempo' sesuai struktur tabel Anda
        $jatuhTempo = Peminjaman::where('user_id', $userId)
            ->where('status', 'dipinjam')
            ->where('tgl_jatuh_tempo', '<=', now()->addDays(3))
            ->with('book')
            ->get();

        // 4. Data Kategori Populer
        // Mengambil kategori, bisa disesuaikan dengan relasi jika ada
        $kategoriPopuler = Category::take(8)->get();

        return view('pages.user.dashboard.index', compact(
            'totalPinjam', 
            'dipinjam', 
            'selesai', 
            'totalDenda', 
            'rekomendasi', 
            'jatuhTempo', 
            'kategoriPopuler'
        ));
    }
}