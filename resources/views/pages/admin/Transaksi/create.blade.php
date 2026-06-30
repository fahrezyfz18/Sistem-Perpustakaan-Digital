@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-background p-4 sm:p-6">
    
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-kombu">Sirkulasi Baru</h1>
        <p class="text-sm text-gray-500 mt-1">Formulir petugas untuk mencatat peminjaman buku perpustakaan.</p>
    </div>

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl font-medium">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border max-w-2xl p-6">
        <form action="{{ route('admin.transaksi.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Anggota / Peminjam
                </label>
                <select name="user_id" id="user_id" 
                        class="w-full border border-gray-200 focus:border-kombu focus:ring-kombu px-4 py-2.5 rounded-xl text-sm text-gray-700 transition-all @error('user_id') border-red-500 @enderror">
                    <option value="">-- Pilih Anggota Perpustakaan --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} (ID: {{ $user->id }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="book_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Buku yang Dipinjam
                </label>
                <select name="book_id" id="book_id" 
                        class="w-full border border-gray-200 focus:border-kombu focus:ring-kombu px-4 py-2.5 rounded-xl text-sm text-gray-700 transition-all @error('book_id') border-red-500 @enderror">
                    <option value="">-- Pilih Judul Buku (Ready) --</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                            {{ $book->judul }} — [Stok: {{ $book->stok }} eks]
                        </option>
                    @endforeach
                </select>
                @error('book_id')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-xs text-gray-500 space-y-1">
                <p class="font-semibold text-gray-600">💡 Informasi Petugas:</p>
                <p>• Tanggal pinjam akan otomatis tercatat sesuai hari ini.</p>
                <p>• Durasi jatuh tempo pengembalian otomatis mengikuti konfigurasi sistem perpustakaan.</p>
                <p>• Sistem akan otomatis mengurangi stok fisik buku setelah tombol simpan ditekan.</p>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('admin.transaksi.index') }}" 
                   class="bg-gray-100 hover:bg-gray-200 text-gray-600 transition-colors px-5 py-2.5 rounded-xl text-sm font-semibold text-center border">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-kombu hover:opacity-90 transition-opacity text-white font-semibold px-6 py-2.5 rounded-xl text-sm shadow-sm shadow-kombu/10">
                    Simpan Transaksi
                </button>
            </div>

        </form>
    </div>

</div>
@endsection