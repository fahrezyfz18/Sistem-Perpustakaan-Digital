<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Setting;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::query();

        // SEARCH
        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // PAGINATION
        $data = $query->paginate(8);

        // HITUNG DENDA
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
        $setting = Setting::first();

        $dendaPerHari = $setting->denda_per_hari ?? 2000;

        $today = Carbon::now()->startOfDay();
        $kembali = Carbon::parse($item->tgl_kembali)->startOfDay();

        if ($today->gt($kembali) && $item->status != 'kembali') {
            return $kembali->diffInDays($today) * $dendaPerHari;
        }

        return 0;
    }
}