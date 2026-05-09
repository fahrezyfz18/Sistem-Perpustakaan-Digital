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
        $query = Peminjaman::with([
            'user',
            'book'
        ]);

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->search) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%');

            })
            ->orWhereHas('book', function ($q) use ($request) {

                $q->where('judul', 'like', '%' . $request->search . '%');

            });

        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $data = $query
            ->latest()
            ->paginate(10);

        /*
        |--------------------------------------------------------------------------
        | HITUNG DENDA
        |--------------------------------------------------------------------------
        */

        foreach ($data as $item) {

            $item->denda = $this->hitungDenda($item);

        }

        return view(
            'pages.admin.transaksi.index',
            compact('data')
        );
    }

    public function show($id)
    {
        $data = Peminjaman::with([
            'user',
            'book'
        ])->findOrFail($id);

        $data->denda = $this->hitungDenda($data);

        return view(
            'pages.admin.transaksi.detail',
            compact('data')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HITUNG DENDA
    |--------------------------------------------------------------------------
    */

    private function hitungDenda($item)
    {
        $setting = Setting::first();

        $dendaPerHari = $setting->denda_per_hari ?? 2000;

        $today = Carbon::now()->startOfDay();

        /*
        |--------------------------------------------------------------------------
        | JIKA BELUM ADA TANGGAL KEMBALI
        |--------------------------------------------------------------------------
        */

        if (!$item->tanggal_kembali) {

            return 0;

        }

        $kembali = Carbon::parse(
            $item->tanggal_kembali
        )->startOfDay();

        /*
        |--------------------------------------------------------------------------
        | JIKA TERLAMBAT
        |--------------------------------------------------------------------------
        */

        if (
            $today->gt($kembali) &&
            $item->status != 'dikembalikan'
        ) {

            return $kembali
                ->diffInDays($today) * $dendaPerHari;

        }

        return 0;
    }
}