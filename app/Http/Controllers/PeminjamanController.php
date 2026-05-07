<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        return view('pages.user.borrow.index');
    }

    public function status()
    {
        return view('pages.user.borrow.status');
    }
}