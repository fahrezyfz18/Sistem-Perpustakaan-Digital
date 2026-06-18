<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();

        $latestBooks = Book::latest()
            ->take(4)
            ->get();

        $userId = auth()->id();

        // TOTAL PEMINJAMAN
        $totalPeminjaman = Peminjaman::where('user_id', $userId)
            ->count();

        // SEDANG DIPINJAM
        $dipinjam = Peminjaman::where('user_id', $userId)
            ->where('status', 'dipinjam')
            ->count();

        // RIWAYAT SELESAI
        $riwayat = Peminjaman::where('user_id', $userId)
            ->where('status', 'dikembalikan')
            ->count();

        // RIWAYAT LIST
        $riwayatPeminjaman = Peminjaman::with('book')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        // SEMENTARA DEFAULT 0
        // karena kolom denda belum ada di database
        $totalDenda = 0;

        $avgDenda = 0;

        return view('pages.user.dashboard.index', compact(
            'totalBooks',
            'latestBooks',
            'totalPeminjaman',
            'dipinjam',
            'riwayat',
            'riwayatPeminjaman',
            'totalDenda',
            'avgDenda'
        ));
    }
}