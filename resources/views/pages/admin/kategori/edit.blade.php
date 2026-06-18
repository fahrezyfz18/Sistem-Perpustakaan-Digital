@extends('layouts.admin')

@section('content')

<div class="max-w-xl mx-auto bg-white rounded-xl shadow p-6">

    <h1 class="text-xl font-bold mb-4">
        Edit Kategori
    </h1>

    <form action="{{ route('admin.kategori.update',$kategori->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <input
            type="text"
            name="nama"
            value="{{ $kategori->nama }}"
            class="w-full border rounded-lg">

        <button
            class="mt-4 bg-secondary text-white px-4 py-2 rounded-lg">

            Update

        </button>

    </form>

</div>

@endsection