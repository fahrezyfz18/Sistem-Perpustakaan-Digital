@extends('layouts.admin')

@section('content')

<!-- WRAPPER -->
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

        <!-- FORM -->
        <div class="p-6">

            <form
                action="{{ route('admin.buku.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-5">

                @csrf

                <!-- JUDUL -->
                <div>

                    <label class="text-sm text-gray-600">
                        Judul
                    </label>

                    <input
                        type="text"
                        name="judul"
                        value="{{ old('judul') }}"
                        placeholder="Masukkan judul buku"
                        class="w-full mt-1 border rounded-lg p-2
                               focus:ring-2 focus:ring-primary outline-none">

                    @error('judul')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- ISBN -->
                <div>

                    <label class="text-sm text-gray-600">
                        ISBN
                    </label>

                    <input
                        type="text"
                        name="isbn"
                        value="{{ old('isbn') }}"
                        placeholder="Masukkan ISBN"
                        class="w-full mt-1 border rounded-lg p-2
                               focus:ring-2 focus:ring-primary outline-none">

                    @error('isbn')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- PENULIS -->
                <div>

                    <label class="text-sm text-gray-600">
                        Penulis
                    </label>

                    <input
                        type="text"
                        name="penulis"
                        value="{{ old('penulis') }}"
                        placeholder="Masukkan nama penulis"
                        class="w-full mt-1 border rounded-lg p-2
                               focus:ring-2 focus:ring-primary outline-none">

                    @error('penulis')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- PENERBIT -->
                <div>

                    <label class="text-sm text-gray-600">
                        Penerbit
                    </label>

                    <input
                        type="text"
                        name="penerbit"
                        value="{{ old('penerbit') }}"
                        placeholder="Masukkan penerbit"
                        class="w-full mt-1 border rounded-lg p-2
                               focus:ring-2 focus:ring-primary outline-none">

                    @error('penerbit')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- KATEGORI -->
                <div>

                    <label class="text-sm text-gray-600">
                        Kategori
                    </label>

                    <input
                        type="text"
                        name="kategori"
                        value="{{ old('kategori') }}"
                        placeholder="Masukkan kategori"
                        class="w-full mt-1 border rounded-lg p-2
                               focus:ring-2 focus:ring-primary outline-none">

                    @error('kategori')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- TAHUN & STOK -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- TAHUN -->
                    <div>

                        <label class="text-sm text-gray-600">
                            Tahun
                        </label>

                        <input
                            type="number"
                            name="tahun"
                            value="{{ old('tahun') }}"
                            placeholder="2025"
                            class="w-full mt-1 border rounded-lg p-2
                                   focus:ring-2 focus:ring-primary outline-none">

                        @error('tahun')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <!-- STOK -->
                    <div>

                        <label class="text-sm text-gray-600">
                            Stok
                        </label>

                        <input
                            type="number"
                            name="stok"
                            value="{{ old('stok') }}"
                            placeholder="0"
                            class="w-full mt-1 border rounded-lg p-2
                                   focus:ring-2 focus:ring-primary outline-none">

                        @error('stok')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                <!-- COVER -->
                <div>

                    <label class="text-sm text-gray-600">
                        Cover Buku
                    </label>

                    <input
                        type="file"
                        name="cover"
                        class="w-full mt-1 border rounded-lg p-2
                               bg-white
                               focus:ring-2 focus:ring-primary outline-none">

                    @error('cover')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- DESKRIPSI -->
                <div>

                    <label class="text-sm text-gray-600">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="5"
                        placeholder="Masukkan deskripsi buku"
                        class="w-full mt-1 border rounded-lg p-2
                               focus:ring-2 focus:ring-primary outline-none">{{ old('deskripsi') }}</textarea>

                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full bg-secondary text-white py-3 rounded-lg
                           hover:bg-camel transition font-semibold">

                    Simpan Data

                </button>

            </form>

        </div>

    </div>

</div>

@endsection