<x-guest-layout>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block mb-1 text-sm font-semibold text-primary">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-primary focus:border-primary block w-full p-2.5 outline-none transition-all" 
                placeholder="Masukkan email" required autofocus>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block mb-1 text-sm font-semibold text-primary">Password</label>
            <input type="password" name="password" id="password" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-primary focus:border-primary block w-full p-2.5 outline-none transition-all" 
                placeholder="Masukkan password" required>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-2">
            <label class="flex items-center text-sm text-gray-600">
                <input type="checkbox" name="remember" 
                    class="mr-2 rounded border-gray-300 text-primary focus:ring-primary">
                Ingat saya
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" 
                   class="text-sm text-secondary hover:underline font-semibold">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Button -->
        <div class="pt-2">
            <button type="submit" 
                class="w-full text-white bg-primary hover:bg-opacity-90 
                       focus:ring-4 focus:outline-none focus:ring-olivine 
                       font-bold rounded-lg text-md px-5 py-3 text-center 
                       transition-all transform active:scale-[0.98] shadow-lg">
                Login
            </button>
        </div>

        <!-- Link ke Register -->
        <div class="flex items-center justify-center mt-4">
            <p class="text-sm text-gray-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-secondary hover:underline font-bold">
                    Daftar di sini
                </a>
            </p>
        </div>

    </form>

</x-guest-layout>