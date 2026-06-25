@extends('layouts.admin')

@section('content')

    <div class="min-h-screen bg-background flex items-center justify-center p-6">

        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-lg border border-gray-100">

            <!-- HEADER -->
            <div class="bg-primary text-white p-5 rounded-t-2xl">
                <h1 class="text-xl md:text-2xl font-semibold text-center">
                    Tambah Buku
                </h1>

                <p class="text-sm text-center text-gray-200 mt-1">
                    Masukkan data buku baru ke sistem
                </p>
            </div>

            <!-- VALIDATION ERROR -->
            @if ($errors->any())
                <div class="m-6 p-4 rounded-lg bg-red-50 border border-red-200">
                    <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- FORM -->
            <div class="p-6">

                <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">

                    @csrf

                    <!-- COVER -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Cover Buku
                        </label>

                        <input type="file" name="cover" accept="image/jpeg,image/png,image/jpg" class="w-full border border-gray-300 rounded-lg p-3
                                       text-sm text-gray-600
                                       file:mr-4
                                       file:px-4
                                       file:py-2
                                       file:rounded-lg
                                       file:border-0
                                       file:bg-primary
                                       file:text-white
                                       hover:file:bg-secondary
                                       transition">

                        <p class="text-xs text-gray-400 mt-2">
                            Format: JPG, JPEG, PNG • Maksimal 5 MB
                        </p>
                    </div>

                    <!-- JUDUL -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Judul Buku
                        </label>

                        <input type="text" name="judul" placeholder="Masukkan judul buku" value="{{ old('judul') }}" class="w-full border border-gray-300 rounded-lg p-3
                                       placeholder:text-gray-400 placeholder:text-sm
                                       focus:ring-2 focus:ring-primary
                                       focus:border-primary
                                       outline-none transition duration-200">
                    </div>

                    <!-- ISBN -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            ISBN
                        </label>

                        <input type="text" name="isbn" placeholder="Masukkan nomor ISBN" value="{{ old('isbn') }}" class="w-full border border-gray-300 rounded-lg p-3
                                       placeholder:text-gray-400 placeholder:text-sm
                                       focus:ring-2 focus:ring-primary
                                       focus:border-primary
                                       outline-none transition duration-200">
                    </div>

                    <!-- PENULIS -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Penulis
                        </label>

                        <input type="text" name="penulis" placeholder="Masukkan nama penulis" value="{{ old('penulis') }}"
                            class="w-full border border-gray-300 rounded-lg p-3
                                       placeholder:text-gray-400 placeholder:text-sm
                                       focus:ring-2 focus:ring-primary
                                       focus:border-primary
                                       outline-none transition duration-200">
                    </div>

                    <!-- PENERBIT -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Penerbit
                        </label>

                        <input type="text" name="penerbit" placeholder="Masukkan nama penerbit"
                            value="{{ old('penerbit') }}" class="w-full border border-gray-300 rounded-lg p-3
                                       placeholder:text-gray-400 placeholder:text-sm
                                       focus:ring-2 focus:ring-primary
                                       focus:border-primary
                                       outline-none transition duration-200">
                    </div>

                    <!-- KATEGORI -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Kategori
                        </label>

                       <select name="kategori_id" class="w-full border border-gray-300 rounded-lg p-3
                       text-gray-400
                       focus:ring-2 focus:ring-primary
                       focus:border-primary
                       outline-none transition duration-200" required>

                            <option value="" selected disabled>
                                Pilih kategori buku
                            </option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}
                                    class="text-gray-700">
                                    {{ $category->nama }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- TAHUN & STOK -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Tahun Terbit
                            </label>

                            <input type="number" name="tahun" min="1900" max="{{ date('Y') }}" step="1" placeholder="Contoh: 2025"
                                value="{{ old('tahun') }}" class="w-full border border-gray-300 rounded-lg p-3
                                           placeholder:text-gray-400 placeholder:text-sm
                                           focus:ring-2 focus:ring-primary
                                           focus:border-primary
                                           outline-none transition duration-200">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Stok
                            </label>

                            <input type="number" name="stok" min="0" step="1" placeholder="Jumlah stok"
                                value="{{ old('stok') }}" class="w-full border border-gray-300 rounded-lg p-3
                                           placeholder:text-gray-400 placeholder:text-sm
                                           focus:ring-2 focus:ring-primary
                                           focus:border-primary
                                           outline-none transition duration-200">
                        </div>

                    </div>

                    <!-- DESKRIPSI -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi" rows="4" placeholder="Masukkan deskripsi buku" class="w-full border border-gray-300 rounded-lg p-3
                                       placeholder:text-gray-400 placeholder:text-sm
                                       focus:ring-2 focus:ring-primary
                                       focus:border-primary
                                       outline-none transition duration-200">{{ old('deskripsi') }}</textarea>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit" class="w-full bg-secondary text-white py-3 rounded-lg
                                   hover:bg-camel transition duration-300
                                   font-semibold shadow-sm">

                        Simpan Data

                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection