<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Peminjaman::paginate(10);

        foreach ($data as $item) {
            $item->denda = $this->hitungDenda($item);
        }

        return view('pages.admin.transaksi.index', compact('data'));
    }

    public function show($id)
    {
        $data = Peminjaman::findOrFail($id);

        $data->denda = $this->hitungDenda($data);

        return view('pages.admin.transaksi.detail', compact('data'));
    }

    private function hitungDenda($item)
    {
        $dendaPerHari = 2000;

        $today = Carbon::now()->startOfDay();
        $kembali = Carbon::parse($item->tgl_kembali)->startOfDay();

        if ($today->gt($kembali) && $item->status != 'kembali') {
            return $kembali->diffInDays($today) * $dendaPerHari;
        }

        return 0;
    }
}