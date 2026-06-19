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

        /*
        |--------------------------------------------------------------------------
        | SETTINGS
        |--------------------------------------------------------------------------
        */

        $setting = Setting::first();

        $dendaPerHari = $setting->denda_per_hari ?? 2000;


        /*
        |--------------------------------------------------------------------------
        | DATA TERLAMBAT
        |--------------------------------------------------------------------------
        */

        $terlambat = (clone $query)
            ->with(['book', 'user'])
            ->where('status', 'terlambat')
            ->get();

        $totalDenda = 0;

        foreach ($terlambat as $item) {

            $today = Carbon::now()->startOfDay();

            $kembali = Carbon::parse(
                $item->deadline
            )->startOfDay();

            $item->hari_telat = $kembali->diffInDays($today);

            $item->denda = $item->hari_telat * $dendaPerHari;

            $totalDenda += $item->denda;
        }


        /*
        |--------------------------------------------------------------------------
        | TOP BUKU
        |--------------------------------------------------------------------------
        */

        $topBooks = (clone $query)
            ->with('book')
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

        $topUsers = (clone $query)
            ->with('user')
            ->selectRaw('user_id, COUNT(*) as total')
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $chartData = (clone $query)
            ->selectRaw('DATE(tanggal_pinjam) as tanggal')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $chartLabels = $chartData
            ->pluck('tanggal')
            ->map(fn($d) => Carbon::parse($d)->format('d M'))
            ->values();

        $chartValues = $chartData
            ->pluck('total')
            ->values();

        $totalPeminjaman = (clone $query)->count();

        $totalDikembalikan = (clone $query)
            ->where('status', 'dikembalikan')
            ->count();

        $totalTerlambat = (clone $query)
            ->where('status', 'terlambat')
            ->count();

        $totalDenda = $terlambat->sum('denda');

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

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

            $today = Carbon::now()->startOfDay();

            $kembali = Carbon::parse(
                $item->deadline
            )->startOfDay();

            if (
                $today->gt($kembali) &&
                $item->status != 'dikembalikan'
            ) {

                $hariTelat = $kembali->diffInDays($today);

                $item->denda = $hariTelat * $dendaPerHari;
            } else {

                $item->denda = 0;
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
                'Tanggal Kembali',
                'Status',
                'Denda'
            ]);


            /*
            |--------------------------------------------------------------------------
            | DATA CSV
            |--------------------------------------------------------------------------
            */

            foreach ($data as $row) {

                fputcsv($file, [

                    $row->user->name ?? '-',

                    $row->book->judul ?? '-',

                    $row->tanggal_pinjam,

                    $row->deadline,

                    $row->status,

                    $row->denda ?? 0,
                ]);
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
