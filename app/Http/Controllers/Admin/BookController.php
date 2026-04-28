<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function show(Book $buku)
    {
        return view('pages.admin.books.detail', compact('buku'));
    }

    public function edit(Book $buku)
    {
        return view('pages.admin.books.edit', compact('buku'));
    }

    public function update(Request $request, Book $buku)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'kategori' => 'required',
            'tahun' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        $buku->update($request->all());

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil diupdate');
    }

    public function destroy(Book $buku)
    {
        $buku->delete();

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}