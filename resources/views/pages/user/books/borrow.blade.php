@extends('layouts.user')

@section('content')

    <div class="min-h-screen bg-background p-6">

        <!-- HEADER -->
        <div class="mb-6">

            <h1 class="text-4xl font-bold text-kombu">
                Form Peminjaman Buku
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Konfirmasi data peminjaman sebelum buku dipinjam
            </p>

            <!-- REALTIME CLOCK -->
            <div
                class="mt-3 bg-white inline-block px-3 sm:px-4 py-2 rounded-lg shadow border text-xs sm:text-sm text-gray-600">
                <span id="realtimeClock"></span>
            </div>

        </div>

        <script>
            function updateClock() {

                const now = new Date();

                const format = localStorage.getItem('dateFormat') || 'full';

                let optionsDate = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                };

                let date = now.toLocaleDateString('id-ID', optionsDate);
                let time = now.toLocaleTimeString('id-ID');

                let output = '';

                if (format === 'full') {
                    output = `${date} • ${time}`;
                }

                if (format === 'short') {
                    output = `${now.toLocaleDateString('id-ID')} • ${time}`;
                }

                if (format === 'time-only') {
                    output = time;
                }

                document.getElementById('realtimeClock').innerHTML = output;
            }

            updateClock();
            setInterval(updateClock, 1000);
        </script>

        <div class="flex justify-center">

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
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ date('Y-m-d') }}"
                                min="{{ date('Y-m-d') }}"
                                class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-primary outline-none">
                        </x-input>

                        <!-- DEADLINE -->
                        <x-input label="Deadline Pengembalian">
                            <input type="date" name="deadline" id="deadline" min="{{ date('Y-m-d') }}"
                                max="{{ now()->addDays(7)->format('Y-m-d') }}"
                                class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-primary outline-none">
                        </x-input>
                    </div>

                    <script>
                        document.getElementById('tanggal_pinjam').onchange = function () {
                            // alert(this.value);
                            // this.value + 7 hari;

                            document.getElementById('deadline').setAttribute('max', '2026-06-30');
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