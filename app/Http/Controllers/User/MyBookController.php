<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class MyBookController extends Controller
{
    /**
     * Menampilkan daftar buku milik user.
     */
    public function index(Request $request)
    {
        $query = Peminjaman::with([
            'book.category'
        ])
        ->where('user_id', auth()->id());

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $books = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Jumlah untuk badge
        $jumlahDipinjam = Peminjaman::where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->count();

        $jumlahDikembalikan = Peminjaman::where('user_id', auth()->id())
            ->where('status', 'dikembalikan')
            ->count();

        return view(
            'pages.user.mybooks.index',
            compact(
                'books',
                'jumlahDipinjam',
                'jumlahDikembalikan'
            )
        );
    }

    /**
     * Detail buku.
     */
    public function detail($id)
    {
        $book = Peminjaman::with([
            'book.category'
        ])
        ->where('user_id', auth()->id())
        ->findOrFail($id);

        return view(
            'pages.user.mybooks.detail',
            compact('book')
        );
    }
}