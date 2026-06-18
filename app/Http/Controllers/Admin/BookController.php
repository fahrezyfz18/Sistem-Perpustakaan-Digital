<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class BookController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (UPDATED: SEARCH + CATEGORY FILTER)
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = $request->search;
        $category = $request->category;

        $books = Book::with('category')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                        ->orWhere('penulis', 'like', "%{$search}%");
                });
            })
            ->when($category, function ($query) use ($category) {
                $query->where('category_id', $category);
            })
            ->latest()
            ->paginate(10);

        $categories = Category::orderBy('nama')->get();

        return view('pages.admin.books.index', [
            'books' => $books,
            'categories' => $categories
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $categories = Category::orderBy('nama')->get();

        return view('pages.admin.books.create', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'judul' => 'required|string|max:100',
            'isbn' => 'nullable|string|max:30',
            'penulis' => 'required|string|max:50',
            'penerbit' => 'required|string|max:50',

            // UPDATED: pakai category_id (lebih standar)
            'category_id' => 'required|exists:categories,id',

            'tahun' => 'required|numeric',
            'stok' => 'required|numeric',

            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request
                ->file('cover')
                ->store('books', 'public');
        }

        Book::create($validated);

        return redirect()
            ->route('admin.buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Book $buku)
    {
        return view('pages.admin.books.detail', compact('buku'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Book $buku)
    {
        $categories = Category::orderBy('nama')->get();

        return view(
            'pages.admin.books.edit',
            compact('buku', 'categories')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Book $buku)
    {
        $validated = $request->validate([

            'judul' => 'required|string|max:100',
            'isbn' => 'nullable|string|max:30',
            'penulis' => 'required|string|max:50',
            'penerbit' => 'required|string|max:50',

            // UPDATED
            'category_id' => 'required|exists:categories,id',

            'tahun' => 'required|numeric',
            'stok' => 'required|numeric',

            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable',
        ]);

        if ($request->hasFile('cover')) {

            if (
                $buku->cover &&
                Storage::disk('public')->exists($buku->cover)
            ) {
                Storage::disk('public')->delete($buku->cover);
            }

            $validated['cover'] = $request
                ->file('cover')
                ->store('books', 'public');
        }

        $buku->update($validated);

        return redirect()
            ->route('admin.buku.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(Book $buku)
    {
        if (
            $buku->cover &&
            Storage::disk('public')->exists($buku->cover)
        ) {
            Storage::disk('public')->delete($buku->cover);
        }

        $buku->delete();

        return redirect()
            ->route('admin.buku.index')
            ->with('success', 'Data buku berhasil dihapus.');
    }
}