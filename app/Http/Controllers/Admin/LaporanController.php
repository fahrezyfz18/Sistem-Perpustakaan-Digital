<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::query();

        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $data = $query->latest()->paginate(8);

        $dendaPerHari = 2000;

        foreach ($data as $item) {
            $today = Carbon::now()->startOfDay();
            $kembali = Carbon::parse($item->tgl_kembali)->startOfDay();

            if ($today->gt($kembali) && $item->status != 'kembali') {
                $selisih = $kembali->diffInDays($today);
                $item->status = 'terlambat';
                $item->denda = $selisih * $dendaPerHari;
            } else {
                $item->denda = 0;
            }
        }

        $grafik = DB::table('peminjaman')
            ->select(DB::raw("MONTH(tgl_pinjam) as bulan"), DB::raw("COUNT(*) as total"))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $labels = [];
        $values = [];

        foreach ($grafik as $bulan => $total) {
            $labels[] = Carbon::create()->month($bulan)->format('M');
            $values[] = $total;
        }

        $peminjamanBulanIni = Peminjaman::whereMonth('tgl_pinjam', now()->month)->count();
        $pengembalianBulanIni = Peminjaman::where('status', 'kembali')
            ->whereMonth('tgl_kembali', now()->month)->count();
        $anggotaBaru = DB::table('users')
            ->whereMonth('created_at', now()->month)->count();

        $totalDenda = $data->sum('denda');

        return view('pages.admin.laporan.index', compact(
            'data',
            'labels',
            'values',
            'peminjamanBulanIni',
            'pengembalianBulanIni',
            'anggotaBaru',
            'totalDenda'
        ));
    }

    public function exportCsv()
    {
        $data = Peminjaman::all();

        $filename = "laporan_peminjaman.csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Nama', 'Judul Buku', 'Tanggal Pinjam', 'Tanggal Kembali', 'Status', 'Denda'
            ]);

            $dendaPerHari = 2000;

            foreach ($data as $item) {
                $today = Carbon::now()->startOfDay();
                $kembali = Carbon::parse($item->tgl_kembali)->startOfDay();

                if ($today->gt($kembali) && $item->status != 'kembali') {
                    $selisih = $kembali->diffInDays($today);
                    $denda = $selisih * $dendaPerHari;
                    $status = 'terlambat';
                } else {
                    $denda = 0;
                    $status = $item->status;
                }

                fputcsv($file, [
                    $item->nama,
                    $item->judul,
                    $item->tgl_pinjam,
                    $item->tgl_kembali,
                    $status,
                    $denda
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf()
    {
        $data = Peminjaman::all();

        $pdf = Pdf::loadView('pages.admin.laporan.pdf', compact('data'));

        return $pdf->download('laporan_peminjaman.pdf');
    }

    public function show($id)
    {
        $data = Peminjaman::findOrFail($id);

        $dendaPerHari = 2000;

        $today = Carbon::now()->startOfDay();
        $kembali = Carbon::parse($data->tgl_kembali)->startOfDay();

        if ($today->gt($kembali) && $data->status != 'kembali') {
            $selisih = $kembali->diffInDays($today);
            $data->status = 'terlambat';
            $data->denda = $selisih * $dendaPerHari;
        } else {
            $data->denda = 0;
        }

        return view('pages.admin.transaksi.detail', compact('data'));
    }
}