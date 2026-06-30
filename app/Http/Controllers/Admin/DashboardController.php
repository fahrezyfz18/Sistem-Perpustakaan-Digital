<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. STATISTIK UTAMA
        $stats = [
            'total_buku' => Book::count(),
            'kategori'   => Category::count(),
            'anggota'    => Anggota::count(),
            'peminjaman' => Peminjaman::where('status', 'dipinjam')->count(),
            'terlambat'  => Peminjaman::where('status', 'dipinjam')
                                ->where('tgl_jatuh_tempo', '<', now())
                                ->count(),
        ];

        // 2. STOK BUKU & KRITIS
        $totalStokFisik = Book::sum('stok');
        $bukuSedangDipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $bukuDiRak = $totalStokFisik - $bukuSedangDipinjam;
        $stokKritis = Book::where('stok', '<=', 1)->count();

        // 3. BUKU & ANGGOTA TERPOPULER
        $topBooks = Peminjaman::select('book_id', DB::raw('count(*) as total'))
            ->with('book')
            ->whereMonth('tanggal_pinjam', now()->month)
            ->groupBy('book_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        $topUsers = Peminjaman::select('user_id', DB::raw('count(*) as total'))
            ->with('user')
            ->whereMonth('tanggal_pinjam', now()->month)
            ->groupBy('user_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // 4. DAFTAR TERLAMBAT
        $terlambat = Peminjaman::where('status', 'dipinjam')
            ->where('tgl_jatuh_tempo', '<', now())
            ->with(['user', 'book'])
            ->get();

        // 5. CHART DATA
        $chartData = Peminjaman::select(DB::raw('DATE(tanggal_pinjam) as date'), DB::raw('count(*) as count'))
            ->where('tanggal_pinjam', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $chartLabels = $chartData->pluck('date')->map(fn($d) => Carbon::parse($d)->format('d M'));
        $chartValues = $chartData->pluck('count');

        // 6. LOG AKTIVITAS (Mengambil 5 transaksi terakhir)
        $recentLogs = Peminjaman::latest()->limit(5)->get()->map(function($item) {
            return (object) [
                'activity_message' => "Transaksi {$item->status} oleh {$item->user->name}",
                'created_at' => $item->created_at
            ];
        });

        return view('pages.admin.dashboard', compact(
            'stats', 'bukuDiRak', 'bukuSedangDipinjam', 'stokKritis',
            'topBooks', 'topUsers', 'terlambat', 'chartLabels', 'chartValues', 'recentLogs'
        ));
    }
}