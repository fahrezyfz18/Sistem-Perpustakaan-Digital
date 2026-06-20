<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'book']);

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->whereHas('user', function ($user) use ($search) {
                    $user->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('book', function ($book) use ($search) {
                    $book->where('judul', 'like', "%{$search}%");
                });

            });
        }

        $transaksi = $query
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view(
            'pages.admin.transaksi.index',
            compact('transaksi')
        );
    }

    public function show($id)
    {
        $data = Peminjaman::with(['user', 'book'])
            ->findOrFail($id);

        return view(
            'pages.admin.transaksi.detail',
            compact('data')
        );
    }
}