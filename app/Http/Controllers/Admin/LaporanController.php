<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // dummy data (nanti bisa dari database)
        $data = collect([
            [
                'nama' => 'Andi Pratama',
                'judul' => 'Bumi',
                'tgl_pinjam' => '2023-10-15',
                'tgl_kembali' => '2023-10-29',
                'status' => 'dipinjam'
            ],
            [
                'nama' => 'Citra Amelia',
                'judul' => 'Laskar Pelangi',
                'tgl_pinjam' => '2023-10-01',
                'tgl_kembali' => '2023-10-15',
                'status' => 'kembali'
            ],
            [
                'nama' => 'Bayu Saputra',
                'judul' => 'Laskar Pelangi',
                'tgl_pinjam' => '2023-09-20',
                'tgl_kembali' => '2023-10-04',
                'status' => 'terlambat'
            ],
        ]);

        // search
        if ($request->search) {
            $data = $data->filter(function ($item) use ($request) {
                return str_contains(strtolower($item['nama']), strtolower($request->search));
            });
        }

        return view('pages.admin.laporan.index', compact('data'));
    }
}