<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $kategori = $request->kategori;

        $books = Book::query()

            ->when($search, function ($query) use ($search) {

                $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%");

            })

            ->when($kategori, function ($query) use ($kategori) {

                $query->where('kategori', $kategori);

            })

            ->latest()
            ->paginate(12);

        $categories = Book::select('kategori')
            ->distinct()
            ->pluck('kategori');

        return view(
            'pages.user.books.index',
            compact('books', 'categories')
        );
    }


    public function show(Book $book)
    {
        return view(
            'pages.user.books.detail',
            compact('book')
        );
    }
}