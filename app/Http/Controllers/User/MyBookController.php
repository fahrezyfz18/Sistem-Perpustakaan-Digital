<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;

class MyBookController extends Controller
{
    public function index()
    {
        $books = Peminjaman::where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->latest()
            ->paginate(10);

        return view('user.my-books.index', compact('books'));
    }
}   