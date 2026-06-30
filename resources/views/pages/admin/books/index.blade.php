@extends('layouts.app')

@section('content')

    <x-page 
        title="Kelola Data Buku" 
        subtitle="Manajemen koleksi buku perpustakaan" 
        :action="route('admin.buku.create')"
        actionText="Tambah Buku"
    >

        @if(session('success'))
            <div id="successAlert" class="mb-4 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium shadow-sm transition-opacity duration-500">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(() => {
                    const alert = document.getElementById('successAlert');
                    if (alert) {
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500);
                    }
                }, 3000);
            </script>
        @endif

        <x-search-filter 
            :action="route('admin.buku.index')" 
            placeholder="Cari judul atau penulis..."
            :categories="$categories ?? []" 
        />

        <x-table :headers="['Cover', 'Judul', 'ISBN', 'Penulis', 'Penerbit', 'Kategori', 'Tahun', 'Stok', 'Aksi']">

            @forelse($books as $book)
                <x-table-row>

                    <x-table-cell>
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" class="w-10 h-14 object-cover rounded-lg shadow-sm mx-auto border">
                        @else
                            <div class="w-10 h-14 bg-gray-100 rounded-lg border border-dashed flex items-center justify-center mx-auto text-[10px] text-gray-400">
                                No Cover
                            </div>
                        @endif
                    </x-table-cell>

                    <x-table-cell>
                        <div class="max-w-[180px] truncate font-semibold text-gray-900 mx-auto">
                            {{ $book->judul }}
                        </div>
                    </x-table-cell>
                    
                    <x-table-cell>{{ $book->isbn }}</x-table-cell>
                    <x-table-cell>{{ $book->penulis }}</x-table-cell>
                    <x-table-cell>{{ $book->penerbit }}</x-table-cell>
                    <x-table-cell>{{ $book->category?->nama ?? '-' }}</x-table-cell>
                    <x-table-cell>{{ $book->tahun }}</x-table-cell>
                    <x-table-cell>
                        <span class="font-bold {{ $book->stok < 2 ? 'text-red-600' : 'text-gray-700' }}">
                            {{ $book->stok }}
                        </span>
                    </x-table-cell>

                    <x-table-cell>
                        <div class="flex justify-center items-center gap-1.5">
                            <a href="{{ route('admin.buku.show', $book->id) }}"
                               class="px-2.5 py-1.5 rounded-xl bg-olivine/10 text-kombu hover:bg-olivine/20 transition text-xs font-bold border border-olivine/20">
                                Detail
                            </a>

                            <a href="{{ route('admin.buku.edit', $book->id) }}"
                               class="px-2.5 py-1.5 rounded-xl bg-amber-50 text-amber-700 hover:bg-amber-100 transition text-xs font-bold border border-amber-200/60">
                                Edit
                            </a>

                            <form action="{{ route('admin.buku.destroy', $book->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-2.5 py-1.5 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition text-xs font-bold border border-red-200/60">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </x-table-cell>

                </x-table-row>
            @empty
                <x-table-row>
                    <td colspan="9" class="px-6 py-12 text-center text-gray-400 font-medium bg-white">
                        Koleksi data buku tidak ditemukan.
                    </td>
                </x-table-row>
            @endforelse

        </x-table>

    </x-page>

@endsection