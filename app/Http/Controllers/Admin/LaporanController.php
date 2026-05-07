<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Setting;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        $dendaPerHari = $setting->denda_per_hari ?? 2000;

        // DATA TERLAMBAT
        $terlambat = Peminjaman::where('status', 'terlambat')->get();

        foreach ($terlambat as $item) {

            $today = Carbon::now()->startOfDay();
            $kembali = Carbon::parse($item->tgl_kembali)->startOfDay();

            $item->hari_telat = $kembali->diffInDays($today);

            $item->denda = $item->hari_telat * $dendaPerHari;
        }

        // TOP BUKU
        $topBooks = Peminjaman::selectRaw('judul, COUNT(*) as total')
            ->groupBy('judul')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // TOP USER
        $topUsers = Peminjaman::selectRaw('nama, COUNT(*) as total')
            ->groupBy('nama')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('pages.admin.laporan.index', compact(
            'terlambat',
            'topBooks',
            'topUsers'
        ));
    }

    public function export(Request $request)
    {
        $data = Peminjaman::all();

        $setting = Setting::first();

        $dendaPerHari = $setting->denda_per_hari ?? 2000;

        // HITUNG DENDA
        foreach ($data as $item) {

            $today = Carbon::now()->startOfDay();

            $kembali = Carbon::parse($item->tgl_kembali)->startOfDay();

            if ($today->gt($kembali) && $item->status != 'kembali') {

                $hariTelat = $kembali->diffInDays($today);

                $item->denda = $hariTelat * $dendaPerHari;

            } else {

                $item->denda = 0;
            }
        }

        // EXPORT PDF
        if ($request->type == 'pdf') {

            $pdf = Pdf::loadView(
                'pages.admin.laporan.pdf',
                compact('data')
            );

            return $pdf->download('laporan.pdf');
        }

        // EXPORT EXCEL / CSV
        $filename = "laporan.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($data) {

            $file = fopen('php://output', 'w');

            // HEADER
            fputcsv($file, [
                'Nama',
                'Judul',
                'Tanggal Pinjam',
                'Tanggal Kembali',
                'Status',
                'Denda'
            ]);

            // DATA
            foreach ($data as $row) {

                fputcsv($file, [
                    $row->nama,
                    $row->judul,
                    $row->tgl_pinjam,
                    $row->tgl_kembali,
                    $row->status,
                    $row->denda
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}