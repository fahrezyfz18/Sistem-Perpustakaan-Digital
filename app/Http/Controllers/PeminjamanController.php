<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        return "Halaman Peminjaman";
    }

    public function status()
    {
        return "Status Peminjaman";
    }
}