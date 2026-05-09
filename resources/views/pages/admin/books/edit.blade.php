@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-background flex items-center justify-center p-6">

    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-lg border border-gray-100">

        <!-- HEADER -->
        <div class="bg-primary text-white p-5 rounded-t-2xl">

            <h1 class="text-xl md:text-2xl font-semibold text-center">
                Edit Buku
            </h1>

            <p class="text-sm text-center text-gray-200 mt-1">
                Perbarui data buku
            </p>

        </div>

        <!-- FORM -->
        <div class="p-6">

            <form
                action="{{ route('admin.buku.update', $buku->id) }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-5">

                @csrf
                @method('PUT')

                <!-- JUDUL -->
                <div>
                    <label class="text-sm text-gray-600">
                        Judul
                    </label>

                    <input
                        type="text"
                        name="judul"
                        value="{{ old('judul', $buku->judul) }}"
                        class="w-full mt-1 border rounded-lg p-2
                               focus:ring-2 focus:ring-primary outline-none">
                </div>

                <!-- ISBN -->
                <div>
                    <label class="text-sm text-gray-600">
                        ISBN
                    </label>

                    <input
                        type="text"
                        name="isbn"
                        value="{{ old('isbn', $buku->isbn) }}"
                        class="w-full mt-1 border rounded-lg p-2
                               focus:ring-2 focus:ring-primary outline-none">
                </div>

                <!-- PENULIS -->
                <div>
                    <label class="text-sm text-gray-600">
                        Penulis
                    </label>

                    <input
                        type="text"
                        name="penulis"
                        value="{{ old('penulis', $buku->penulis) }}"
                        class="w-full mt-1 border rounded-lg p-2
                               focus:ring-2 focus:ring-primary outline-none">
                </div>

                <!-- PENERBIT -->
                <div>
                    <label class="text-sm text-gray-600">
                        Penerbit
                    </label>

                    <input
                        type="text"
                        name="penerbit"
                        value="{{ old('penerbit', $buku->penerbit) }}"
                        class="w-full mt-1 border rounded-lg p-2
                               focus:ring-2 focus:ring-primary outline-none">
                </div>

                <!-- KATEGORI -->
                <div>
                    <label class="text-sm text-gray-600">
                        Kategori
                    </label>

                    <input
                        type="text"
                        name="kategori"
                        value="{{ old('kategori', $buku->kategori) }}"
                        class="w-full mt-1 border rounded-lg p-2
                               focus:ring-2 focus:ring-primary outline-none">
                </div>

                <!-- TAHUN & STOK -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm text-gray-600">
                            Tahun
                        </label>

                        <input
                            type="number"
                            name="tahun"
                            value="{{ old('tahun', $buku->tahun) }}"
                            class="w-full mt-1 border rounded-lg p-2
                                   focus:ring-2 focus:ring-primary outline-none">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">
                            Stok
                        </label>

                        <input
                            type="number"
                            name="stok"
                            value="{{ old('stok', $buku->stok) }}"
                            class="w-full mt-1 border rounded-lg p-2
                                   focus:ring-2 focus:ring-primary outline-none">
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
                        class="w-full mt-1 border rounded-lg p-2">

                </div>

                <!-- PREVIEW COVER -->
                @if($buku->cover)

                    <div>

                        <img
                            src="{{ asset('storage/' . $buku->cover) }}"
                            class="w-32 rounded-lg shadow">

                    </div>

                @endif

                <!-- DESKRIPSI -->
                <div>

                    <label class="text-sm text-gray-600">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="5"
                        class="w-full mt-1 border rounded-lg p-2
                               focus:ring-2 focus:ring-primary outline-none">{{ old('deskripsi', $buku->deskripsi) }}</textarea>

                </div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full bg-secondary text-white py-3 rounded-lg
                           hover:bg-camel transition font-semibold">

                    Update Data

                </button>

            </form>

        </div>

    </div>

</div>

@endsection