@extends('layouts.admin')

@section('content')

<div class="p-6">
    <h1 class="text-xl font-semibold mb-4">Detail Peminjaman</h1>

    <div class="bg-white p-6 rounded shadow space-y-2">
        <p><b>Nama:</b> {{ $data->nama }}</p>
        <p><b>Judul:</b> {{ $data->judul }}</p>
        <p><b>Tanggal Pinjam:</b> {{ $data->tgl_pinjam }}</p>
        <p><b>Tanggal Kembali:</b> {{ $data->tgl_kembali }}</p>
        <p><b>Status:</b> {{ $data->status }}</p>

        <!-- 🔥 TAMBAHKAN DI SINI -->
        <p><b>Denda:</b> 
            @if(isset($data->denda) && $data->denda > 0)
                Rp {{ number_format($data->denda, 0, ',', '.') }}
            @else
                -
            @endif
        </p>

    </div>
</div>

@endsection