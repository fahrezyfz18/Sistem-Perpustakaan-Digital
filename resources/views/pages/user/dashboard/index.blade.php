@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-background p-4 sm:p-6 space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-4xl font-bold text-kombu tracking-tight">Dashboard</h1>
                <p class="text-sm text-gray-500 mt-1">Halo, {{ auth()->user()->name }}! Ringkasan aktivitas Anda hari ini.
                </p>
                <div
                    class="mt-3 bg-white inline-flex items-center gap-2 px-4 py-2 rounded-xl shadow-sm border text-xs text-gray-600">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span id="realtimeClockUser"></span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-kombu">
                <p class="text-gray-500 text-sm">Total Pinjam</p>
                <h2 class="text-2xl font-bold text-kombu">{{ $totalPinjam ?? 0 }}</h2>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-olivine">
                <p class="text-gray-500 text-sm">Sedang Dipinjam</p>
                <h2 class="text-2xl font-bold text-olivine">{{ $dipinjam ?? 0 }}</h2>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-mustard">
                <p class="text-gray-500 text-sm">Buku Selesai</p>
                <h2 class="text-2xl font-bold text-mustard">{{ $selesai ?? 0 }}</h2>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-red-500">
                <p class="text-gray-500 text-sm">Total Denda</p>
                <h2 class="text-2xl font-bold text-red-500">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-5 rounded-xl shadow-sm border">
                    <h3 class="text-lg font-bold text-kombu mb-4">Rekomendasi untuk Anda</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @forelse($rekomendasi ?? [] as $book)
                            <a href="{{ route('user.books.show', $book->id) }}"
                                class="border rounded-xl p-3 hover:shadow-md transition">
                                <img src="{{ $book->cover ? asset('storage/' . $book->cover) : asset('images/no-cover.png') }}"
                                    class="w-full h-32 object-cover rounded-lg mb-2">
                                <h4 class="font-bold text-sm text-gray-800 line-clamp-1">{{ $book->judul }}</h4>
                                <p class="text-xs text-gray-500">{{ $book->penulis }}</p>
                            </a>
                        @empty
                            <p class="text-sm text-gray-400 col-span-3">Belum ada rekomendasi buku saat ini.</p>
                        @endforelse
                    </div>
                </div>

                @if(isset($jatuhTempo) && $jatuhTempo->count() > 0)
                    <div class="bg-red-50 p-5 rounded-xl shadow-sm border border-red-100">
                        <h3 class="text-lg font-bold text-red-700 mb-3">⚠️ Segera Dikembalikan</h3>
                        <div class="space-y-2">
                            @foreach($jatuhTempo as $item)
                                <div class="flex justify-between bg-white p-3 rounded-lg border border-red-100 text-sm">
                                    <span class="font-medium text-gray-700">{{ $item->book->judul }}</span>
                                    <span class="font-bold text-red-500">Tgl:
                                        {{ \Carbon\Carbon::parse($item->tgl_jatuh_tempo)->format('d M Y') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="space-y-6">
                <div class="bg-white p-5 rounded-xl shadow-sm border">
                    <h3 class="text-lg font-bold text-kombu mb-4">Akses Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('user.books.index') }}"
                            class="block w-full text-center bg-kombu text-white py-3 rounded-lg text-sm font-semibold hover:opacity-90 transition">Cari
                            Buku</a>
                        <a href="{{ route('user.my-books.index') }}"
                            class="block w-full text-center bg-gray-100 text-gray-700 py-3 rounded-lg text-sm font-semibold hover:bg-gray-200 transition">Pinjaman
                            Saya</a>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl shadow-sm border">
                    <h3 class="text-lg font-bold text-kombu mb-4">Kategori Populer</h3>
                    <div class="flex flex-wrap gap-2">
                        @forelse(($kategoriPopuler ?? []) as $kat)
                            <a href="{{ route('user.books.index', ['kategori' => $kat->id]) }}"
                                class="bg-gray-100 text-gray-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-kombu hover:text-white transition">
                                {{ $kat->nama_kategori }}
                            </a>
                        @empty
                            <p class="text-xs text-gray-400">Belum ada kategori.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <script>
            function updateClockUser() {
                const now = new Date();
                const dateStr = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                const timeStr = now.toLocaleTimeString('id-ID');
                document.getElementById('realtimeClockUser').innerHTML = `${dateStr} • ${timeStr}`;
            }
            setInterval(updateClockUser, 1000);
            updateClockUser();
        </script>
    </div>
@endsection