@extends('layouts.admin')

@section('content')

    <div class="min-h-screen bg-background p-6 space-y-6">

        <!-- HEADER -->
        <div>
            <h1 class="text-3xl font-bold text-kombu">Pengaturan Sistem</h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola konfigurasi aplikasi perpustakaan
            </p>
        </div>

        <!-- GRID SETTINGS -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


            <!-- UBAH PASSWORD -->
            <div class="bg-white p-6 rounded-2xl shadow border border-kombu/10">

                <div class="flex items-center gap-3 mb-5">
                    <svg class="w-5 h-5 text-kombu" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>

                    <h2 class="font-semibold text-kombu text-lg">Ubah Password</h2>
                </div>

                <form method="POST" action="#">
                    @csrf

                    <div class="space-y-4">

                        <div>
                            <label class="text-sm text-gray-600">Password Baru</label>
                            <input type="password"
                                class="w-full mt-1 rounded-lg border-gray-200 focus:border-kombu focus:ring-kombu"
                                placeholder="Masukkan password baru">
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Konfirmasi Password</label>
                            <input type="password"
                                class="w-full mt-1 rounded-lg border-gray-200 focus:border-kombu focus:ring-kombu"
                                placeholder="Ulangi password">
                        </div>

                    </div>

                    <button type="submit" class="mt-5 bg-kombu text-white px-4 py-2 rounded-lg hover:bg-accent transition">
                        Simpan Password
                    </button>

                </form>
            </div>


            <!-- ATURAN PEMINJAMAN -->
            <div class="bg-white p-6 rounded-2xl shadow border border-olivine/20">

                <div class="flex items-center gap-3 mb-5">
                    <svg class="w-5 h-5 text-olivine" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6M5 8h14M5 16h14M5 20h14M5 4h14" />
                    </svg>

                    <h2 class="font-semibold text-olivine text-lg">Aturan Peminjaman</h2>
                </div>

                <form method="POST" action="#">
                    @csrf

                    <div class="space-y-4">

                        <div>
                            <label class="text-sm text-gray-600">Batas Hari Pinjam</label>
                            <input type="number"
                                class="w-full mt-1 rounded-lg border-gray-200 focus:border-olivine focus:ring-olivine"
                                value="7">
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Denda per Hari (Rp)</label>
                            <input type="number"
                                class="w-full mt-1 rounded-lg border-gray-200 focus:border-olivine focus:ring-olivine"
                                value="2000">
                        </div>

                    </div>

                    <button type="submit"
                        class="mt-5 bg-olivine text-white px-4 py-2 rounded-lg hover:bg-asparagus transition">
                        Simpan Aturan
                    </button>

                </form>
            </div>


            <!-- NOTIFIKASI -->
            <div class="bg-white p-6 rounded-2xl shadow border border-mustard/20">

                <div class="flex items-center gap-3 mb-5">
                    <svg class="w-5 h-5 text-mustard" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0" />
                    </svg>

                    <h2 class="font-semibold text-mustard text-lg">Notifikasi Sistem</h2>
                </div>

                <form method="POST" action="#">
                    @csrf

                    <div class="space-y-4 text-sm text-gray-600">

                        <label class="flex items-center justify-between">
                            <span>Notifikasi Peminjaman</span>
                            <input type="checkbox" class="accent-mustard">
                        </label>

                        <label class="flex items-center justify-between">
                            <span>Notifikasi Pengembalian</span>
                            <input type="checkbox" class="accent-mustard">
                        </label>

                        <label class="flex items-center justify-between">
                            <span>Notifikasi Denda</span>
                            <input type="checkbox" class="accent-mustard">
                        </label>

                    </div>

                    <button type="submit" class="mt-5 bg-mustard text-white px-4 py-2 rounded-lg hover:bg-camel transition">
                        Simpan Notifikasi
                    </button>

                </form>
            </div>

        </div>

        <!-- REALTIME SETTING -->
        <div class="bg-white p-6 rounded-2xl shadow border border-kombu/10">

            <div class="flex items-center gap-3 mb-5">

                <svg class="w-5 h-5 text-kombu" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <h2 class="font-semibold text-kombu text-lg">
                    Pengaturan Waktu Real-Time
                </h2>

            </div>

            <!-- PREVIEW -->
            <div class="mb-4 p-3 bg-gray-50 rounded-lg border text-sm text-gray-600">
                <span id="previewClock">Loading...</span>
            </div>

            <!-- BUTTON SET FORMAT -->
            <div class="space-y-2 text-sm">

                <button onclick="setFormat('full')" class="w-full px-3 py-2 border rounded-lg hover:bg-gray-50 transition">
                    Full (Hari, Tanggal, Jam)
                </button>

                <button onclick="setFormat('short')" class="w-full px-3 py-2 border rounded-lg hover:bg-gray-50 transition">
                    Short (Tanggal + Jam)
                </button>

                <button onclick="setFormat('time-only')"
                    class="w-full px-3 py-2 border rounded-lg hover:bg-gray-50 transition">
                    Hanya Jam
                </button>

            </div>

        </div>

        <script>
            function getFormat() {
                return localStorage.getItem('dateFormat') || 'full';
            }

            function updatePreview() {
                const now = new Date();
                const format = getFormat();

                let text = '';

                const date = now.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                const time = now.toLocaleTimeString('id-ID');

                if (format === 'full') {
                    text = `${date} • ${time}`;
                }
                else if (format === 'short') {
                    text = `${now.toLocaleDateString('id-ID')} • ${time}`;
                }
                else {
                    text = `${time}`;
                }

                document.getElementById('previewClock').innerText = text;
            }

            function setFormat(type) {
                localStorage.setItem('dateFormat', type);
                updatePreview();
            }

            updatePreview();
            setInterval(updatePreview, 1000);
        </script>

        <!-- BACKUP & LAPORAN -->
        <div class="bg-white p-6 rounded-2xl shadow border border-secondary/20">

            <div class="flex items-center gap-3 mb-4">

                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 7v10a2 2 0 002 2h12a2 2 0 002-2V7M4 7l8 5 8-5M4 7l8-4 8 4" />
                </svg>

                <h2 class="font-semibold text-secondary text-lg">
                    Backup & Laporan Data
                </h2>
            </div>

            <p class="text-sm text-gray-500 mb-5">
                Unduh data sistem perpustakaan untuk backup dan kebutuhan arsip.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                <a href="#" class="text-center bg-secondary text-white py-2 rounded-lg hover:bg-camel transition">
                    Backup Database
                </a>

                <a href="{{ route('admin.laporan.export') }}"
                    class="text-center bg-kombu text-white py-2 rounded-lg hover:bg-accent transition">
                    Export Excel
                </a>

                <a href="{{ route('admin.laporan.export', ['type' => 'pdf']) }}"
                    class="text-center bg-mustard text-white py-2 rounded-lg hover:bg-camel transition">
                    Export PDF
                </a>

            </div>

        </div>

    </div>

@endsection