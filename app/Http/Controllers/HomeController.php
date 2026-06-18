<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::latest()->take(8)->get();

        $data = $this->getData();

        return view('home', compact('books', 'data'));
    }

    // data untuk ditampilkan di home
    private function getData()
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
}