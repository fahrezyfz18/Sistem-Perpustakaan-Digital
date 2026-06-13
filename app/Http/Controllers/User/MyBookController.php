<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class MyBookController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index( Request $request )
    {
        $books = Peminjaman::with('book')
            ->where('user_id', auth()->id())
            ->where('status', $request->query('status') ?? 'dipinjam')
            ->latest()
            ->get();

        return view(
            'pages.user.mybooks.index',
            compact('books')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {
        $book = Peminjaman::with('book')

            ->where('user_id', auth()->id())

            ->findOrFail($id);

        return view(
            'pages.user.mybooks.detail',
            compact('book')
        );
    }
}