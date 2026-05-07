<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $books = \App\Models\Book::latest()->take(8)->get();

        return view('home', compact('books'));
    }
}

  // data untuk ditampilkan di home
    public function getData()
    {
        return [
            ['nama' => 'Total Buku', 'jumlah' => 120],
            ['nama' => 'Buku Dipinjam', 'jumlah' => 35],
            ['nama' => 'Anggota', 'jumlah' => 50]
        ];
    }

    public function tampilkan()
    {
        $data = $this->getData();

        return view('home', compact('data'));
    }

public function index()
{
    $books = \App\Models\Book::latest()->take(8)->get();

    return view('home', compact('books'));
}
}