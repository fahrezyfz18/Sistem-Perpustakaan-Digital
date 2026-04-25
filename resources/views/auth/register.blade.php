<x-guest-layout>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block mb-1 text-sm font-semibold text-primary ">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 outline-none transition-all" 
                placeholder="Masukkan nama" required autofocus>
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div>
            <label for="email" class="block mb-1 text-sm font-semibold text-primary">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 outline-none transition-all" 
                placeholder="Masukkan email" required>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <label for="no_hp" class="block mb-1 text-sm font-semibold text-primary">No. HP</label>
            <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 outline-none transition-all" 
                placeholder="Masukkan nomor HP">
            <x-input-error :messages="$errors->get('no_hp')" class="mt-1" />
        </div>

        <div>
            <label for="alamat" class="block mb-1 text-sm font-semibold text-primary">Alamat</label>
            <textarea name="alamat" id="alamat" rows="2" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 outline-none transition-all" 
                placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
            <x-input-error :messages="$errors->get('alamat')" class="mt-1" />
        </div>

        <div>
            <label for="password" class="block mb-1 text-sm font-semibold text-primary">Password</label>
            <input type="password" name="password" id="password" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 outline-none transition-all" 
                placeholder="Masukkan password" required>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div>
            <label for="password_confirmation" class="block mb-1 text-sm font-semibold text-primary">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 outline-none transition-all" 
                placeholder="Ulangi password" required>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-2">
            <button type="submit" 
                class="w-full text-white bg-primary hover:bg-opacity-90 focus:ring-4 focus:outline-none focus:ring-olivine font-bold rounded-lg text-md px-5 py-3 text-center transition-all transform active:scale-[0.98] shadow-lg">
                Daftar
            </button>
        </div>

        <div class="flex items-center justify-center mt-4">
            <p class="text-sm text-gray-500">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-secondary hover:underline font-bold">
                    Login di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>