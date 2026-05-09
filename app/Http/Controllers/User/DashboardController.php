<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();

        $latestBooks = Book::latest()
            ->take(4)
            ->get();

        return view('pages.user.dashboard.index', compact(
            'totalBooks',
            'latestBooks'
        ));
    }
}