@extends('layouts.admin')

@section('content')

<!-- WRAPPER -->
<div class="min-h-screen bg-background flex items-center justify-center p-6">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg border border-gray-100">

        <!-- HEADER -->
        <div class="bg-primary text-white p-5 rounded-t-2xl">
            <h1 class="text-xl md:text-2xl font-semibold text-center">
                Tambah Buku
            </h1>

            <p class="text-sm text-center text-gray-200 mt-1">
                Masukkan data buku baru ke sistem
            </p>
        </div>

        <!-- ERROR VALIDATION -->
        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 m-4 rounded-lg">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- FORM -->
        <div class="p-6">

            <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">

                @csrf

                <!-- COVER -->
                <div>
                    <label class="text-sm text-gray-600">
                        Cover Buku
                    </label>

                    <input type="file"
                        name="cover"
                        class="w-full mt-1 border rounded-lg p-2"
                        accept="image/jpeg,image/png,image/jpg">

                    <p class="text-xs text-gray-400 mt-1">
                        Format: JPG, JPEG, PNG | Maks: 5MB
                    </p>
                </div>

                <!-- JUDUL -->
                <div>
                    <label class="text-sm text-gray-600">
                        Judul
                    </label>

                    <input type="text" name="judul" placeholder="Masukkan judul buku"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <!-- ISBN -->
                <div>
                    <label class="text-sm text-gray-600">
                        ISBN
                    </label>

                    <input type="text" name="isbn" placeholder="Masukkan ISBN"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <!-- PENULIS -->
                <div>
                    <label class="text-sm text-gray-600">
                        Penulis
                    </label>

                    <input type="text" name="penulis" placeholder="Masukkan nama penulis"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <!-- PENERBIT -->
                <div>
                    <label class="text-sm text-gray-600">
                        Penerbit
                    </label>

                    <input type="text" name="penerbit" placeholder="Masukkan penerbit"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <!-- KATEGORI -->
                <div>
                    <label class="text-sm text-gray-600">
                        Kategori
                    </label>

                    <select name="category_id" class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- TAHUN & STOK -->
                <div class="grid grid-cols-2 gap-3">

                    <div>
                        <label class="text-sm text-gray-600">
                            Tahun
                        </label>

                        <input type="number" name="tahun" placeholder="2025"
                            class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">
                            Stok
                        </label>

                        <input type="number" name="stok" min="0" step="1"
                            class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                    </div>

                </div>

                <!-- DESKRIPSI -->
                <div>
                    <label class="text-sm text-gray-600">
                        Deskripsi
                    </label>

                    <textarea name="deskripsi" rows="4"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none"></textarea>
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-secondary text-white py-2 rounded-lg hover:bg-camel transition font-semibold">
                    Simpan Data
                </button>

            </form>

        </div>

    </div>

</div>

@endsection