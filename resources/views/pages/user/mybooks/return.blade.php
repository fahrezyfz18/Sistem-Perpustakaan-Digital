@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-background flex items-center justify-center p-6">

        <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">

            <!-- HEADER -->
            <div class="bg-primary text-white p-6">
                <h1 class="text-2xl font-semibold text-center">
                    Form Pengembalian Buku
                </h1>
                <p class="text-center text-sm text-gray-200 mt-1">
                    Pastikan buku dikembalikan dalam kondisi baik
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3">

                <!-- COVER -->
                <div class="bg-gray-100 p-6 flex items-center justify-center">

                    @if($book->book && $book->book->cover)

                        <img src="{{ asset('storage/' . $book->book->cover) }}"
                            class="rounded-xl w-full max-w-xs object-cover shadow-md">

                    @else

                        <div class="h-96 flex items-center justify-center text-gray-400">
                            No Cover
                        </div>

                    @endif

                </div>

                <!-- FORM AREA -->
                <div class="md:col-span-2 p-8">

                    <!-- INFO BOOK (tetap, hanya dirapikan spacing) -->
                    <div class="space-y-2 text-sm text-gray-600 mb-6">

                        <p><span class="font-semibold text-kombu">Judul:</span> {{ $book->book->judul ?? '-' }}</p>
                        <p><span class="font-semibold text-kombu">Penulis:</span> {{ $book->book->penulis ?? '-' }}</p>
                        <p><span class="font-semibold text-kombu">Tanggal Pinjam:</span>
                            {{ \Carbon\Carbon::parse($book->tanggal_pinjam)->format('d M Y') }}</p>
                        <p><span class="font-semibold text-kombu">Deadline:</span>
                            {{ \Carbon\Carbon::parse($book->tgl_jatuh_tempo)->format('d M Y') }}</p>

                    </div>

                    <!-- ERROR (disamakan dengan admin style) -->
                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
                            <ul class="list-disc pl-5 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- FORM -->
                    <form action="{{ route('user.my-books.return', $book->id) }}" method="POST" class="space-y-5">

                        @csrf

                        <!-- KONDISI -->
                        <div>
                            <label class="text-sm text-gray-600">Kondisi Buku</label>

                            <select name="kondisi"
                                class="w-full mt-1 border rounded-lg p-3 focus:ring-2 focus:ring-primary outline-none">

                                <option value="baik">Baik</option>
                                <option value="rusak_ringan">Rusak Ringan</option>
                                <option value="rusak_berat">Rusak Berat</option>

                            </select>
                        </div>

                        <!-- CATATAN -->
                        <div>
                            <label class="text-sm text-gray-600">Catatan Pengembalian</label>

                            <textarea name="catatan" rows="4" placeholder="Tambahkan catatan..."
                                class="w-full mt-1 border rounded-lg p-3 focus:ring-2 focus:ring-primary outline-none"></textarea>
                        </div>

                        <!-- BUTTON -->
                        <div class="flex gap-4 pt-2">

                            <a href="{{ route('user.my-books.detail', $book->id) }}"
                                class="flex-1 text-center border border-gray-300 py-3 rounded-lg hover:bg-gray-100 transition">

                                Batal
                            </a>

                            <button type="submit"
                                class="flex-1 bg-secondary text-white py-3 rounded-lg hover:bg-camel transition font-semibold">

                                Konfirmasi
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection