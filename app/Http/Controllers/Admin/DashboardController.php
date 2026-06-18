<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_buku' => 5,
            'kategori' => 5,
            'anggota' => 5,
            'peminjaman' => 3,
            'terlambat' => 1,
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

        $topBooks = [
            (object) [
                'judul' => 'Laravel Dasar',
                'total' => 12,
            ],
            (object) [
                'judul' => 'PHP OOP',
                'total' => 10,
            ],
            (object) [
                'judul' => 'MySQL Fundamental',
                'total' => 8,
            ],
        ];

        return view(
            'pages.admin.dashboard',
            compact(
                'stats',
                'peminjamanTerbaru',
                'topBooks'
            )
        );
    }
}