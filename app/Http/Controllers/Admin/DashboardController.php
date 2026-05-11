<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | SETTINGS
        |--------------------------------------------------------------------------
        */

        $setting = Setting::first();

        $dendaPerHari = $setting->denda_per_hari ?? 2000;

        /*
        |--------------------------------------------------------------------------
        | STATS
        |--------------------------------------------------------------------------
        */

        $stats = [

            'total_buku' => Book::count(),

            'kategori' => Book::distinct('kategori')->count(),

            'anggota' => User::where('role', 'user')->count(),

            'peminjaman' => Peminjaman::where(
                'status',
                'dipinjam'
            )->count(),

        ];

        /*
        |--------------------------------------------------------------------------
        | TOP BOOKS
        |--------------------------------------------------------------------------
        */

        $topBooks = Peminjaman::select('book_id')
            ->selectRaw('count(*) as total')
            ->groupBy('book_id')
            ->with('book')
            ->limit(3)
            ->get()
            ->map(function ($item) {

                return (object) [

                    'judul' => $item->book->judul ?? '-',

                    'total' => $item->total,

                ];

            });

        /*
        |--------------------------------------------------------------------------
        | DATA TERLAMBAT
        |--------------------------------------------------------------------------
        */

        $today = Carbon::now()->startOfDay();

        $terlambat = Peminjaman::with([
                'user',
                'book'
            ])
            ->where('status', 'dipinjam')
            ->whereDate('tanggal_kembali', '<', $today)
            ->get()
            ->map(function ($item) use ($today, $dendaPerHari) {

                $jatuhTempo = Carbon::parse(
                    $item->tanggal_kembali
                )->startOfDay();

                $hariTelat = $jatuhTempo->diffInDays($today);

                $item->hari_telat = $hariTelat;

                $item->denda = $hariTelat * $dendaPerHari;

                return $item;

            });

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.admin.dashboard',
            compact(
                'stats',
                'topBooks',
                'terlambat'
            )
        );
    }
}