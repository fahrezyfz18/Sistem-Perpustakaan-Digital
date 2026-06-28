<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Setting;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $query = Peminjaman::query();

        if ($startDate && $endDate) {

            $query->whereBetween(
                'tanggal_pinjam',
                [$startDate, $endDate]
            );
        }

        $setting = Setting::first();

        $dendaPerHari = $setting->denda_per_hari ?? 2000;

        /*
        |--------------------------------------------------------------------------
        | DATA TERLAMBAT
        |--------------------------------------------------------------------------
        */

        $terlambat = (clone $query)
            ->with(['user', 'book'])
            ->where('status', 'dipinjam')
            ->get()
            ->filter(function ($item) {

                return $item->status_label === 'Terlambat';

            });

        foreach ($terlambat as $item) {

            $item->hari_telat = $item->hari_terlambat;

            $item->denda = $item->denda_terlambat;
        }

        /*
        |--------------------------------------------------------------------------
        | TOP BUKU
        |--------------------------------------------------------------------------
        */

        $topBooks = Peminjaman::with('book')
            ->whereMonth('tanggal_pinjam', now()->month)
            ->whereYear('tanggal_pinjam', now()->year)
            ->selectRaw('book_id, COUNT(*) as total')
            ->groupBy('book_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | TOP USER
        |--------------------------------------------------------------------------
        */

        $topUsers = Peminjaman::with('user')
            ->whereMonth('tanggal_pinjam', now()->month)
            ->whereYear('tanggal_pinjam', now()->year)
            ->selectRaw('user_id, COUNT(*) as total')
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $chartData = (clone $query)
            ->selectRaw('MONTH(tanggal_pinjam) as bulan')
            ->selectRaw('YEAR(tanggal_pinjam) as tahun')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        $chartLabels = $chartData->map(function ($item) {

            return Carbon::create()
                ->month($item->bulan)
                ->translatedFormat('F');

        })->values();

        $chartValues = $chartData
            ->pluck('total')
            ->values();

        $totalPeminjaman = (clone $query)->count();

        $totalDikembalikan = (clone $query)
            ->where('status', 'dikembalikan')
            ->count();

        $totalTerlambat = $terlambat->count();

        $totalDenda = $terlambat->sum(function ($item) {
            return $item->denda_terlambat;
        });

        return view(
            'pages.admin.laporan.index',
            compact(
                'terlambat',
                'topBooks',
                'topUsers',
                'chartLabels',
                'chartValues',
                'totalPeminjaman',
                'totalDikembalikan',
                'totalTerlambat',
                'totalDenda'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT LAPORAN
    |--------------------------------------------------------------------------
    */

    public function export(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $query = Peminjaman::with(['book', 'user']);

        if ($startDate && $endDate) {

            $query->whereBetween(
                'tanggal_pinjam',
                [$startDate, $endDate]
            );
        }

        $data = $query->get();

        $setting = Setting::first();

        $dendaPerHari = $setting->denda_per_hari ?? 2000;


        /*
        |--------------------------------------------------------------------------
        | HITUNG DENDA
        |--------------------------------------------------------------------------
        */

        foreach ($data as $item) {

            if ($item->status_label === 'Terlambat') {

                $item->denda = $item->denda_terlambat;

            } else {

                $item->denda = $item->denda ?? 0;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | EXPORT PDF
        |--------------------------------------------------------------------------
        */

        if ($request->type == 'pdf') {

            $pdf = Pdf::loadView(
                'pages.admin.laporan.pdf',
                compact('data')
            );

            return $pdf->download('laporan.pdf');
        }


        /*
        |--------------------------------------------------------------------------
        | EXPORT CSV
        |--------------------------------------------------------------------------
        */

        $filename = "laporan.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' =>
                'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($data) {

            $file = fopen('php://output', 'w');


            /*
            |--------------------------------------------------------------------------
            | HEADER CSV
            |--------------------------------------------------------------------------
            */

            fputcsv($file, [
                'Nama',
                'Judul Buku',
                'Tanggal Pinjam',
                'Jatuh Tempo',
                'Tanggal Kembali',
                'Status',
                'Denda'
            ]);


            /*
            |--------------------------------------------------------------------------
            | DATA CSV
            |--------------------------------------------------------------------------
            */

            if ($data->isEmpty()) {

                fputcsv($file, [
                    'Tidak ada data pada periode yang dipilih'
                ]);

            } else {

                foreach ($data as $row) {

                    fputcsv($file, [

                        $row->user->name ?? '-',

                        $row->book->judul ?? '-',

                        $row->tanggal_pinjam,

                        $row->tgl_jatuh_tempo,

                        $row->tanggal_dikembalikan,

                        $row->status_label,

                        $row->denda ?? 0,

                    ]);
                }

            }

            fclose($file);
        };

        return response()->stream(
            $callback,
            200,
            $headers
        );
    }
}
