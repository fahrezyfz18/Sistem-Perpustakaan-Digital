@extends('layouts.admin')

@section('content')

    <div class="p-6">

        <h1 class="text-xl font-semibold mb-4">
            Detail Peminjaman
        </h1>

        <div class="bg-white p-6 rounded shadow space-y-3">

            <p>
                <b>Nama:</b>
                {{ $data->user->name ?? '-' }}
            </p>

            <p>
                <b>Judul Buku:</b>
                {{ $data->book->judul ?? '-' }}
            </p>

            <p>
                <b>Tanggal Pinjam:</b>
                {{ $data->tanggal_pinjam?->translatedFormat('d F Y') ?? '-' }}
            </p>

            <p>
                <b>Tanggal Dikembalikan:</b>
                {{ $data->tanggal_dikembalikan?->translatedFormat('d F Y') ?? '-' }}
            </p>

            <p>
                <b>Tgl Jatuh Tempo:</b>
                {{ $data->tgl_jatuh_tempo?->translatedFormat('d F Y') ?? '-' }}
            </p>

            <p>
                <b>Status:</b>
                {{ $data->status_label }}
            </p>

            <p>
                <b>Denda:</b>

                @if($data->denda > 0)

                    Rp {{ number_format($data->denda, 0, ',', '.') }}

                @else

                    -

                @endif

            </p>

        </div>

        <div class="mt-4">
            <a href="{{ route('admin.transaksi.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                Kembali
            </a>
        </div>

    </div>

@endsection