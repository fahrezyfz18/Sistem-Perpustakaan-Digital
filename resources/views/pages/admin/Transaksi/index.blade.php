@extends('layouts.app')

@section('content')

    <x-page 
        title="Transaksi Peminjaman dan Pengembalian" 
        subtitle="Monitoring dan manajemen aktivitas sirkulasi buku perpustakaan"
        :action="route('admin.transaksi.create')"
        actionText="Sirkulasi Baru"
    >

        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl font-medium shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <x-search-filter 
            :action="route('admin.transaksi.index')"
            placeholder="Cari Nama Anggota atau Judul Buku..."
        />

        <x-table :headers="['Nama Anggota', 'Judul Buku', 'Tanggal Pinjam', 'Jatuh Tempo', 'Tanggal Kembali', 'Status', 'Denda', 'Aksi']">
            
            @forelse($transaksi as $item)
                <x-table-row>
                    
                    <x-table-cell>
                        <div class="max-w-[160px] truncate font-semibold text-gray-900 mx-auto">
                            {{ $item->user?->name ?? 'Anggota Terhapus' }}
                        </div>
                    </x-table-cell>

                    <x-table-cell>
                        <div class="max-w-[240px] truncate mx-auto">
                            {{ $item->book?->judul ?? 'Buku Terhapus' }}
                        </div>
                    </x-table-cell>

                    <x-table-cell>
                        {{ $item->tanggal_pinjam?->locale('id')->translatedFormat('d M Y') ?? '-' }}
                    </x-table-cell>

                    <x-table-cell>
                        {{ $item->tgl_jatuh_tempo?->locale('id')->translatedFormat('d M Y') ?? '-' }}
                    </x-table-cell>

                    <x-table-cell>
                        @if($item->status == 'dikembalikan' && $item->tanggal_dikembalikan)
                            <span class="font-semibold text-gray-700">
                                {{ $item->tanggal_dikembalikan->locale('id')->translatedFormat('d M Y') }}
                            </span>
                        @else
                            <span class="text-amber-700 text-xs bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-100">
                                Masih Dipinjam
                            </span>
                        @endif
                    </x-table-cell>

                    <x-table-cell>
                        @if($item->status_label === 'Dikembalikan')
                            <span class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full border border-blue-100">
                                {{ $item->status_label }}
                            </span>
                        @elseif($item->status_label === 'Terlambat')
                            <span class="bg-red-50 text-red-700 text-xs font-bold px-3 py-1.5 rounded-full border border-red-100">
                                {{ $item->status_label }}
                            </span>
                        @else
                            <span class="bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full border border-emerald-100">
                                {{ $item->status_label }}
                            </span>
                        @endif
                    </x-table-cell>

                    <x-table-cell>
                        @if($item->status_label === 'Terlambat')
                            <span class="text-red-600 font-bold">
                                Rp {{ number_format($item->denda_terlambat, 0, ',', '.') }}
                            </span>
                        @else
                            <span class="text-gray-400 font-normal">-</span>
                        @endif
                    </x-table-cell>

                    <x-table-cell>
                        <a href="{{ route('admin.transaksi.show', $item->id) }}"
                           class="text-kombu bg-olivine/20 hover:bg-olivine/40 font-semibold rounded-xl text-xs px-4 py-2 transition duration-200 inline-block border border-olivine/30">
                            Detail
                        </a>
                    </x-table-cell>

                </x-table-row>
            @empty
                <x-table-row>
                    <td colspan="8" class="px-6 py-12 text-center text-gray-400 font-medium bg-white">
                        Belum ada rekaman log data transaksi sirkulasi.
                    </td>
                </x-table-row>
            @endforelse

        </x-table>

        @if ($transaksi->hasPages())
            <div class="mt-6 flex justify-end">
                <div class="pagination-custom-wrapper">
                    {{ $transaksi->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <style>
                /* Hilangkan teks pencatat info "Showing x to y" secara mutlak */
                .pagination-custom-wrapper .small,
                .pagination-custom-wrapper p,
                .pagination-custom-wrapper .text-muted {
                    display: none !important;
                }
                
                /* Pengaturan struktur list tombol */
                .pagination-custom-wrapper ul.pagination {
                    display: flex !important;
                    list-style: none !important;
                    padding-left: 0 !important;
                    gap: 6px !important;
                    align-items: center !important;
                }

                /* Styling dasar seluruh box item tombol angka */
                .pagination-custom-wrapper .page-item .page-link {
                    display: block !important;
                    padding: 8px 14px !important;
                    font-size: 14px !important;
                    font-weight: 600 !important;
                    color: #4b5563 !important; /* gray-600 */
                    background-color: #ffffff !important;
                    border: 1px solid #e5e7eb !important; /* gray-200 */
                    border-radius: 12px !important; /* rounded-xl */
                    text-decoration: none !important;
                    transition: all 0.2s ease !important;
                }

                /* Mengubah warna latar HITAM AKTIF menjadi HIJAU KOMBU */
                .pagination-custom-wrapper .page-item.active .page-link {
                    background-color: #354e3b !important; /* Warna Kombu */
                    border-color: #354e3b !important;
                    color: #ffffff !important;
                }

                /* Efek Hover warna Olivine Soft */
                .pagination-custom-wrapper .page-item:not(.active) .page-link:hover {
                    background-color: rgba(148, 163, 115, 0.15) !important;
                    color: #354e3b !important;
                    border-color: rgba(148, 163, 115, 0.4) !important;
                }

                /* Tombol disable / mati */
                .pagination-custom-wrapper .page-item.disabled .page-link {
                    color: #d1d5db !important; /* gray-300 */
                    background-color: #f9fafb !important; /* gray-50 */
                    border-color: #e5e7eb !important;
                    cursor: not-allowed !important;
                }
            </style>
        @endif

    </x-page>

@endsection