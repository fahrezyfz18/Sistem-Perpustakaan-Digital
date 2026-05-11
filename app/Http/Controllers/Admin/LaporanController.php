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

        $terlambat = Peminjaman::with(['book', 'user'])
            ->where('status', 'terlambat')
            ->get();

        foreach ($terlambat as $item) {

            $today = Carbon::now()->startOfDay();

            $kembali = Carbon::parse(
                $item->tanggal_kembali
            )->startOfDay();

            $item->hari_telat = $kembali->diffInDays($today);

            $item->denda = $item->hari_telat * $dendaPerHari;
        }


        /*
        |--------------------------------------------------------------------------
        | TOP BUKU
        |--------------------------------------------------------------------------
        */

        $topBooks = Peminjaman::with('book')
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
            ->selectRaw('user_id, COUNT(*) as total')
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();


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
                'topUsers'
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
        $data = Peminjaman::with(['book', 'user'])->get();

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
                $item->tanggal_kembali
            )->startOfDay();

            if (
                $today->gt($kembali) &&
                $item->status != 'kembali'
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

                    $row->tanggal_kembali,

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