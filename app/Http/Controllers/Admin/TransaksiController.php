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

        $dendaPerHari = 2000;

        foreach ($data as $item) {
            $today = Carbon::now()->startOfDay();
            $tgl_kembali = Carbon::parse($item->tgl_kembali)->startOfDay();

            if ($today->gt($tgl_kembali) && $item->status != 'kembali') {
                $selisih = $tgl_kembali->diffInDays($today);
                $item->denda = $selisih * $dendaPerHari;
            } else {
                $item->denda = 0;
            }
        }

        return view('pages.admin.transaksi.index', compact('data'));
    }

    public function show($id)
    {
        $data = Peminjaman::findOrFail($id);

        $dendaPerHari = 2000;

        $today = Carbon::now()->startOfDay();
        $tgl_kembali = Carbon::parse($data->tgl_kembali)->startOfDay();

        if ($today->gt($tgl_kembali) && $data->status != 'kembali') {
            $selisih = $tgl_kembali->diffInDays($today);
            $data->denda = $selisih * $dendaPerHari;
        } else {
            $data->denda = 0;
        }

        return view('pages.admin.transaksi.detail', compact('data'));
    }
}