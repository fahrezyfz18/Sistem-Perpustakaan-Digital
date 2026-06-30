<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    /**
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $kategori = $request->kategori;

        $books = Book::with('category')
            ->when($search, function ($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%");
            })
            ->when($request->kategori, function ($query) use ($request) {
                $query->where('kategori_id', $request->kategori);
            })
            ->when($kategori, function ($query) use ($kategori) {

                $query->where('kategori_id', $kategori);
            })
            ->latest()
            ->paginate(12);

        $categories = Category::all();

        return view(
            'pages.user.books.index',
            compact('books', 'categories')
        );
    }

    /**
     * Menampilkan detail buku.
     */
    public function show(Book $book)
    {
        $book->load('category');

        return view(
            'pages.user.books.detail',
            compact('book')
        );
    }
}