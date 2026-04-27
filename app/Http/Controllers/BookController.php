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
        $data = $this->getData();

        return view('pages.admin.books(admin).index', compact('data'));
    } // ⬅️ INI YANG TADI KURANG

    public function index()
    {
        $books = [
            ['judul' => 'Rahvayana - Aku Lala Padamu', 'penulis' => 'Sujiwo Tejo'],
            ['judul' => 'Dermaga Sastra Indonesia', 'penulis' => 'Sujiwo Tejo'],
            ['judul' => 'Pemrograman & Database', 'penulis' => 'Sujiwo Tejo'],
            ['judul' => 'Bumi', 'penulis' => 'Sujiwo Tejo'],
        ];

        return view('books.index', compact('books'));
    }
}