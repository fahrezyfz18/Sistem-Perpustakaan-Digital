<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
public function index()
{
$data = [
'nama' => 'LibraryHub',
'pekerjaan' => 'Developer',
];
return view('home')->with($data);
$nama = "Zie";
$pekerjaan = "Admin";
return view('home', compact('nama', 'pekerjaan'));

}
public function contact()
{
return view('contact');
}
}

