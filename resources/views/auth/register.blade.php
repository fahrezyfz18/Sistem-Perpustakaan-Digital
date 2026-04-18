<x-guest-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <div class="text-center mb-8">
        <div class="bg-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
            <i class="fas fa-book-open text-white text-2xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Daftar Anggota</h2>
        <p class="text-gray-500 text-sm">Bergabung dengan Perpustakaan Digital</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <i class="fas fa-user"></i>
                </span>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus 
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm outline-none transition-all" 
                    placeholder="Nama lengkap Anda">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <i class="fas fa-envelope"></i>
                </span>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm outline-none transition-all" 
                    placeholder="nama@email.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <i class="fas fa-lock"></i>
                </span>
                <input id="password" name="password" type="password" required 
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm outline-none transition-all" 
                    placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <i class="fas fa-check-double"></i>
                </span>
                <input id="password_confirmation" name="password_confirmation" type="password" required 
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm outline-none transition-all" 
                    placeholder="Ulangi kata sandi">
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg shadow-lg shadow-indigo-200 transition-all transform active:scale-[0.98]">
                Daftar Sekarang
            </button>
        </div>

        <div class="flex items-center justify-center mt-6">
            <p class="text-sm text-gray-600">
                Sudah punya akun? 
                <a class="text-indigo-600 hover:underline font-bold" href="{{ route('login') }}">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>