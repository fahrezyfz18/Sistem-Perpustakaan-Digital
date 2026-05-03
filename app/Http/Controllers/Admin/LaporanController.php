<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::query();

        // 🔍 SEARCH
        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // 📄 PAGINATION
        $data = $query->latest()->paginate(8);

        // 🔥 HITUNG DENDA + STATUS OTOMATIS
        foreach ($data as $item) {

            $tglKembali = Carbon::parse($item->tgl_kembali);

            // ✅ FIX: pakai >= (biar hari yang sama tetap kena)
            if ($item->status != 'kembali' && now()->greaterThanOrEqualTo($tglKembali)) {

                $hariTelat = now()->diffInDays($tglKembali);

                // set status otomatis
                $item->status = 'terlambat';

                // 💰 DENDA
                $item->denda = $hariTelat * 1000;

            } else {
                $item->denda = 0;
            }
        }

        return view('pages.admin.Transaksi.index', compact('data'));
    }

    // 🔥 DETAIL
    public function show($id)
    {
        $data = Peminjaman::findOrFail($id);

        $tglKembali = Carbon::parse($data->tgl_kembali);

        // ✅ FIX: sama dengan index (WAJIB konsisten)
        if ($data->status != 'kembali' && now()->greaterThanOrEqualTo($tglKembali)) {

            $hariTelat = now()->diffInDays($tglKembali);

            $data->status = 'terlambat';
            $data->denda = $hariTelat * 1000;

        } else {
            $data->denda = 0;
        }

        return view('pages.admin.Transaksi.detail', compact('data'));
    }
}