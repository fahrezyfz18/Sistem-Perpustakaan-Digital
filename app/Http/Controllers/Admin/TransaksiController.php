<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now();

        $transaksi = collect([
            [
                'nama' => 'User 1',
                'buku' => 'Laravel Dasar',
                'tgl_pinjam' => '2026-05-01',
                'jatuh_tempo' => '2026-05-08',
                'status' => 'Dipinjam',
            ],
            [
                'nama' => 'User 2',
                'buku' => 'Clean Code',
                'tgl_pinjam' => '2026-05-02',
                'jatuh_tempo' => '2026-05-09',
                'status' => 'Dikembalikan',
            ],
            [
                'nama' => 'User 3',
                'buku' => 'Atomic Habits',
                'tgl_pinjam' => '2026-05-03',
                'jatuh_tempo' => '2026-05-10',
                'status' => 'Dipinjam',
            ],
            [
                'nama' => 'User 4',
                'buku' => 'Flutter Mobile',
                'tgl_pinjam' => '2026-05-04',
                'jatuh_tempo' => '2026-05-11',
                'status' => 'Dipinjam',
            ],
             [
                'nama' => 'User 5',
                'buku' => 'Pemrograman Web',
                'tgl_pinjam' => '2026-05-05',
                'jatuh_tempo' => '2026-05-12',
                'status' => 'Dikembalikan',
            ],
            [
                'nama' => 'User 6',
                'buku' => 'Laskar Pelangi',
                'tgl_pinjam' => '2026-05-06',
                'jatuh_tempo' => '2026-05-13',
                'status' => 'Dipinjam',
            ],
            [
                'nama' => 'User 7',
                'buku' => 'Bumi',
                'tgl_pinjam' => '2026-05-07',
                'jatuh_tempo' => '2026-05-14',
                'status' => 'Dipinjam',
            ],
            [
                'nama' => 'User 8',
                'buku' => 'PHP Modern',
                'tgl_pinjam' => '2026-05-08',
                'jatuh_tempo' => '2026-05-15',
                'status' => 'Dikembalikan',
            ],
            [
                'nama' => 'User 9',
                'buku' => 'Rich Dad Poor Dad',
                'tgl_pinjam' => '2026-05-09',
                'jatuh_tempo' => '2026-05-16',
                'status' => 'Dipinjam',
            ],
            [
                'nama' => 'User 10',
                'buku' => 'Design Pattern',
                'tgl_pinjam' => '2026-05-10',
                'jatuh_tempo' => '2026-05-17',
                'status' => 'Dipinjam',
            ],
            [
                'nama' => 'User 11',
                'buku' => 'Database MySQL',
                'tgl_pinjam' => '2026-05-11',
                'jatuh_tempo' => '2026-05-18',
                'status' => 'Dipinjam',
            ],
            [
                'nama' => 'User 12',
                'buku' => 'UI UX Design',
                'tgl_pinjam' => '2026-05-12',
                'jatuh_tempo' => '2026-05-19',
                'status' => 'Dikembalikan',
            ],
            [
                'nama' => 'User 13',
                'buku' => 'JavaScript Expert',
                'tgl_pinjam' => '2026-05-13',
                'jatuh_tempo' => '2026-05-20',
                'status' => 'Dipinjam',
            ],
            [
                 'nama' => 'User 14',
                'buku' => 'Machine Learning',
                'tgl_pinjam' => '2026-05-14',
                'jatuh_tempo' => '2026-05-21',
                'status' => 'Dipinjam',
            ],
            [
                'nama' => 'User 15',
                'buku' => 'Cyber Security',
                'tgl_pinjam' => '2026-05-15',
                'jatuh_tempo' => '2026-05-22',
                'status' => 'Dipinjam',
            ],
            [
                'nama' => 'User 16',
                'buku' => 'React JS',
                'tgl_pinjam' => '2026-05-16',
                'jatuh_tempo' => '2026-05-23',
                'status' => 'Dipinjam',
            ],
        ]);

        $transaksi = $transaksi->map(function ($item) use ($today) {

            $jatuhTempo = Carbon::parse($item['jatuh_tempo']);

            if ($item['status'] !== 'Dikembalikan' && $today->gt($jatuhTempo)) {

                $hariTerlambat = $jatuhTempo->diffInDays($today);

                $item['status'] = 'Terlambat';
                $item['denda'] = $hariTerlambat * 2000;
            } else {
                $item['denda'] = 0;
            }

            return $item;
        });
 if ($request->search) {
            $search = strtolower($request->search);

            $transaksi = $transaksi->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['nama']), $search)
                    || str_contains(strtolower($item['buku']), $search);
            });
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $perPage = 8;

        $currentItems = $transaksi
            ->slice(($currentPage - 1) * $perPage, $perPage)
            ->values();
             $transaksi = new LengthAwarePaginator(
            $currentItems,
            $transaksi->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('pages.admin.transaksi.index', compact('transaksi'));
    }
}