@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">

    <div class="bg-white p-6 rounded-lg shadow">

        <h1 class="text-xl font-bold text-kombu mb-4">Detail Anggota</h1>

        <p><b>Kode:</b> {{ $anggota->kode_anggota }}</p>
        <p><b>Nama:</b> {{ $anggota->nama }}</p>
        <p><b>Email:</b> {{ $anggota->email }}</p>
        <p><b>No HP:</b> {{ $anggota->no_hp }}</p>
        <p><b>Alamat:</b> {{ $anggota->alamat }}</p>

        <a href="{{ route('admin.anggota.index') }}"
           class="inline-block mt-4 bg-kombu text-white px-4 py-2 rounded">
            Kembali
        </a>

    </div>

</div>
@endsection