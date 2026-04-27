<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(10);

        return view('pages.admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('pages.admin.books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isbn' => 'nullable',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'kategori' => 'required',
            'tahun' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        Book::create($request->all());

        return redirect()->route('admin.buku.index');
    }
}