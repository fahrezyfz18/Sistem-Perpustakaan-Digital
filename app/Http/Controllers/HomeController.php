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
}

