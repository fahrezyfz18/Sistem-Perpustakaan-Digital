<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class MyBookController extends Controller
{
    public function index()
    {
        $books = \App\Models\Peminjaman::with('book')
            ->where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->latest()
            ->get();

        return view(
            'pages.user.mybooks.index',
            compact('books')
        );
    }
}