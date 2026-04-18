<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function tampilkan($kode, $judul)
    {
        return view('list_buku', [
            'kode' => $kode,
            'judul' => $judul
        ]);
    }
}