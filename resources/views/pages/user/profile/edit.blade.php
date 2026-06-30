@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-background p-4 sm:p-6">
    <div class="max-w-3xl mx-auto space-y-6">
        <h1 class="text-2xl font-bold text-kombu">Edit Profil</h1>

        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-2xl shadow-sm border space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label class="text-sm font-semibold text-gray-700">Foto Profil</label>
                <input type="file" name="avatar" class="w-full mt-1 p-2 border rounded-xl bg-gray-50">
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full mt-1 p-3 rounded-xl border focus:ring-2 focus:ring-kombu outline-none">
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full mt-1 p-3 rounded-xl border focus:ring-2 focus:ring-kombu outline-none">
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">No. HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="w-full mt-1 p-3 rounded-xl border focus:ring-2 focus:ring-kombu outline-none">
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">Alamat</label>
                <textarea name="alamat" rows="3" class="w-full mt-1 p-3 rounded-xl border focus:ring-2 focus:ring-kombu outline-none">{{ old('alamat', $user->alamat) }}</textarea>
            </div>

            <div class="pt-4 flex gap-3">
                <button type="submit" class="bg-kombu text-white px-6 py-2 rounded-xl text-sm font-semibold hover:opacity-90">Simpan Perubahan</button>
                <a href="{{ route('user.profile.show') }}" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-xl text-sm font-semibold">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection