@extends('layouts.app')

@section('content')

<div class="container py-5">

    <!-- HEADER -->
    <div class="mb-4">
        <h1 class="fw-bold text-leaf">Kelola Anggota</h1>
        <p class="text-muted">Manajemen data anggota LeafShelf</p>
    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-lg rounded-4 p-4">

        <!-- TOP BAR -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <!-- SEARCH -->
            <form method="GET" class="w-50">
                <input type="text" name="search" class="form-control search-box"
                    placeholder="🔍 Cari anggota...">
            </form>

            <!-- BUTTON -->
            <a href="{{ route('anggota.create') }}" class="btn btn-leaf">
                + Tambah Anggota
            </a>

        </div>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table align-middle">

                <thead class="table-head">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($anggotas as $item)
                    <tr class="table-row">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                            <a href="{{ route('anggota.edit', $item->id) }}"
                               class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('anggota.destroy', $item->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <!-- PAGINATION -->
        <div class="mt-3">
            {{ $anggotas->links() }}
        </div>

    </div>

</div>

@endsection