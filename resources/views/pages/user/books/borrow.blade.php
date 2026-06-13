@extends('layouts.user')

@section('content')

    <div class="min-h-screen bg-background flex items-center justify-center p-6">

        <x-form-card title="Form Peminjaman Buku" subtitle="Konfirmasi peminjaman sebelum disimpan">

            <x-form-error />

            <form action="{{ route('user.borrow.store', $book->id) }}" method="POST" class="space-y-5">

                @csrf

                <!-- USER INFO -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <x-input label="Nama Anggota">
                        <input type="text" value="{{ auth()->user()->name }}" disabled
                            class="w-full border rounded-lg p-3 bg-gray-100">
                    </x-input>

                    <x-input label="ID Anggota">
                        <input type="text" value="{{ auth()->user()->id }}" disabled
                            class="w-full border rounded-lg p-3 bg-gray-100">
                    </x-input>

                </div>

                <!-- BOOK INFO -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <x-input label="Judul Buku">
                        <input type="text" value="{{ $book->judul }}" disabled
                            class="w-full border rounded-lg p-3 bg-gray-100">
                    </x-input>

                    <x-input label="Kode Buku">
                        <input type="text" value="{{ $book->id }}" disabled
                            class="w-full border rounded-lg p-3 bg-gray-100">
                    </x-input>

                </div>

                <!-- DATE INFO -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- TANGGAL PINJAM -->
                    <x-input label="Tanggal Pinjam">
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-primary outline-none">
                    </x-input>
                    
                    <!-- DEADLINE -->
                    <x-input label="Deadline Pengembalian">
                        <input type="date" name="deadline" id="deadline" min="{{ date('Y-m-d') }}" max="{{ now()->addDays(7)->format('Y-m-d') }}"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-primary outline-none">
                    </x-input>
                </div>

                <script>
                    document.getElementById('tanggal_pinjam').onchange = function () {
                        // alert(this.value);
                        // this.value + 7 hari;

                        document.getElementById('deadline').setAttribute('max', '2026-06-30' );
                    }
                </script>

                <!-- STATUS -->
                <x-input label="Status">
                    <input type="text" value="Aktif" disabled class="w-full border rounded-lg p-3 bg-gray-100">
                </x-input>

                <!-- BUTTON -->
                <div class="flex gap-4 pt-2">

                    <a href="{{ route('user.books.show', $book->id) }}"
                        class="flex-1 text-center border border-gray-300 py-3 rounded-lg hover:bg-gray-100 transition">

                        Batal
                    </a>

                    <div class="flex-1">
                        <x-button>
                            Simpan Peminjaman
                        </x-button>
                    </div>

                </div>

            </form>

        </x-form-card>

    </div>

@endsection