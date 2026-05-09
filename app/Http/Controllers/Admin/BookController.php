<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    |
    | Menampilkan daftar buku + search
    |
    */

    public function index(Request $request)
    {
        $search = $request->search;

        $books = Book::query()

            ->when($search, function ($query) use ($search) {

                $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");

            })

            ->latest()
            ->paginate(10);

        return view(
            'pages.admin.books.index',
            compact('books')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    |
    | Menampilkan form tambah buku
    |
    */

    public function create()
    {
        return view('pages.admin.books.create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    |
    | Menyimpan data buku baru
    |
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'judul' => 'required|string|max:255',

            'isbn' => 'nullable|string|max:255',

            'penulis' => 'required|string|max:255',

            'penerbit' => 'required|string|max:255',

            'kategori' => 'required|string|max:255',

            'tahun' => 'required|numeric',

            'stok' => 'required|numeric',

            /*
            |--------------------------------------------------------------------------
            | COVER
            |--------------------------------------------------------------------------
            */

            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            /*
            |--------------------------------------------------------------------------
            | DESKRIPSI
            |--------------------------------------------------------------------------
            */

            'deskripsi' => 'nullable',

        ]);


        /*
        |--------------------------------------------------------------------------
        | UPLOAD COVER
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('cover')) {

            $validated['cover'] = $request
                ->file('cover')
                ->store('books', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        Book::create($validated);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.buku.index')
            ->with(
                'success',
                'Buku berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    |
    | Menampilkan detail buku
    |
    */

    public function show(Book $buku)
    {
        return view(
            'pages.admin.books.detail',
            compact('buku')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    |
    | Menampilkan form edit buku
    |
    */

    public function edit(Book $buku)
    {
        return view(
            'pages.admin.books.edit',
            compact('buku')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    |
    | Mengupdate data buku
    |
    */

    public function update(Request $request, Book $buku)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'judul' => 'required|string|max:255',

            'isbn' => 'nullable|string|max:255',

            'penulis' => 'required|string|max:255',

            'penerbit' => 'required|string|max:255',

            'kategori' => 'required|string|max:255',

            'tahun' => 'required|numeric',

            'stok' => 'required|numeric',

            /*
            |--------------------------------------------------------------------------
            | COVER
            |--------------------------------------------------------------------------
            */

            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            /*
            |--------------------------------------------------------------------------
            | DESKRIPSI
            |--------------------------------------------------------------------------
            */

            'deskripsi' => 'nullable',

        ]);


        /*
        |--------------------------------------------------------------------------
        | JIKA ADA COVER BARU
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('cover')) {

            /*
            |--------------------------------------------------------------------------
            | HAPUS COVER LAMA
            |--------------------------------------------------------------------------
            */

            if (
                $buku->cover &&
                Storage::disk('public')->exists($buku->cover)
            ) {

                Storage::disk('public')
                    ->delete($buku->cover);
            }


            /*
            |--------------------------------------------------------------------------
            | UPLOAD COVER BARU
            |--------------------------------------------------------------------------
            */

            $validated['cover'] = $request
                ->file('cover')
                ->store('books', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $buku->update($validated);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.buku.index')
            ->with(
                'success',
                'Data buku berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    |
    | Menghapus buku
    |
    */

    public function destroy(Book $buku)
    {
        /*
        |--------------------------------------------------------------------------
        | HAPUS COVER
        |--------------------------------------------------------------------------
        */

        if (
            $buku->cover &&
            Storage::disk('public')->exists($buku->cover)
        ) {

            Storage::disk('public')
                ->delete($buku->cover);
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS DATA
        |--------------------------------------------------------------------------
        */

        $buku->delete();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.buku.index')
            ->with(
                'success',
                'Data buku berhasil dihapus.'
            );
    }
}