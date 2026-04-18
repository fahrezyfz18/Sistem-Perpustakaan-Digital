<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    // fungsi ambil data
    public function getData()
    {
        return [
            ['judul' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata'],
            ['judul' => 'Bumi', 'penulis' => 'Tere Liye'],
            ['judul' => 'Negeri 5 Menara', 'penulis' => 'Ahmad Fuadi']
        ];
    }

    // fungsi tampilkan ke view
    public function tampilkan()
    {
        $data = $this->getData(); // Ambil data dari fungsi di atasnya

        return view('pages.admin.books(admin).index', compact('data'));
    }
}