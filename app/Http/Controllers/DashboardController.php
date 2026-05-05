<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_buku' => 5,
            'kategori' => 5,
            'anggota' => 5,
            'peminjaman' => 3,
        ];

        $peminjamanTerbaru = [
            [
                'kode' => 'PMJ001',
                'anggota' => 'Budi',
                'buku' => 'Laravel Dasar',
                'tgl_pinjam' => '2024-01-01',
                'tgl_kembali' => '2024-01-07',
                'status' => 'Dipinjam',
            ]
        ];

        return view('pages.admin.dashboard', compact('stats', 'peminjamanTerbaru'));
    }
    public function userDashboard()
    {
        return view('pages.user.dashboard.index');
    }
}