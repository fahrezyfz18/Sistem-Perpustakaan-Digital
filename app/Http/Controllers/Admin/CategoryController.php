<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display listing.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $categories = Category::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->withCount('books')
            ->latest()
            ->paginate(10);

        return view('pages.admin.kategori.index', compact('categories'));

    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('pages.admin.kategori.create');
    }

    /**
     * Store category.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:categories,nama'
        ]);

        Category::create($validated);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Show detail.
     */
    public function show(Category $kategori)
    {
        return view(
            'pages.admin.kategori.show',
            compact('category')
        );
    }

    /**
     * Edit form.
     */
    public function edit(Category $kategori)
    {
        return view('pages.admin.kategori.edit', compact('category'));
    }

    /**
     * Update.
     */
    public function update(Request $request, Category $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:categories,nama,' . $kategori->id
        ]);

        $kategori->update($validated);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Delete.
     */
    public function destroy(Category $kategori)
    {
        if ($kategori->books()->count() > 0) {
            return back()->with(
                'error',
                'Kategori masih digunakan oleh buku.'
            );
        }

        $kategori->delete();

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}