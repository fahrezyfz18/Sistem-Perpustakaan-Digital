<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // =========================
    // INDEX (VERSI DATABASE)
    // =========================
    public function index()
    {
        // data dari database
        $books = Book::latest()->paginate(10);

        return view('pages.admin.books.index', compact('books'));
    }

    // =========================
    // DATA STATIC (VERSI LAMA / TEST)
    // =========================
    public function getData()
    {
        return [
            ['judul' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata'],
            ['judul' => 'Bumi', 'penulis' => 'Tere Liye'],
            ['judul' => 'Negeri 5 Menara', 'penulis' => 'Ahmad Fuadi']
        ];
    }

    // =========================
    // TAMPILKAN DATA STATIC
    // =========================
    public function tampilkan()
    {
        $data = $this->getData();

        return view('pages.admin.books.index', compact('data'));
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        return view('pages.admin.books.create');
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            // contoh validasi (silakan sesuaikan dengan database)
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
        ]);

        Book::create($request->all());

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }
}