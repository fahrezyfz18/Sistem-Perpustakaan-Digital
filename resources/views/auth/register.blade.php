<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center px-4 py-16 bg-asparagus/50">

        <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl p-8 border-t-4 border-primary">

            <!-- LOGO -->
            <div class="text-center mb-6">
                <img src="{{ asset('images/LOGO_LS_TRANSPARAN.png') }}" class="h-16 mx-auto mb-4">
                <h2 class="text-2xl font-bold text-primary">Register</h2>
                <p class="text-xs text-gray-500 italic">
                    Tanam langkah awalmu di dunia literasi.
                </p>
            </div>

            <!-- ERROR GLOBAL -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-600 text-sm p-3 rounded-lg mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- NAMA -->
                <div>
                    <label for="name" class="block mb-1 text-sm font-semibold text-primary ">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 outline-none transition-all"
                        placeholder="Masukkan nama" required autofocus>
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <!-- EMAIL -->
                <div>
                    <label for="email" class="block mb-1 text-sm font-semibold text-primary">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 outline-none transition-all"
                        placeholder="Masukkan email" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- NO. HP -->
                <div>
                    <label for="no_hp" class="block mb-1 text-sm font-semibold text-primary">No. HP</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 outline-none transition-all"
                        placeholder="Masukkan nomor HP">
                    <x-input-error :messages="$errors->get('no_hp')" class="mt-1" />
                </div>


                <!-- ALAMAT -->
                <div>
                    <label for="alamat" class="block mb-1 text-sm font-semibold text-primary">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
           focus:ring-primary focus:border-primary block w-full p-2.5 outline-none 
           transition-all resize-none overflow-hidden" placeholder="Masukkan alamat"
                        oninput="this.style.height='auto'; this.style.height=this.scrollHeight+'px'">{{ old('alamat') }}</textarea>
                    <x-input-error :messages="$errors->get('alamat')" class="mt-1" />
                </div>

                <!-- PASSWORD -->
                <div x-data="{ 
    password: '', 
    confirm: '',
    show: false,
    showConfirm: false,
    get isMin() { return this.password.length >= 6 },
    get hasNumber() { return /[0-9]/.test(this.password) },
    get isSame() { return this.password === this.confirm && this.password !== '' }
}">

                    <div class="mb-4">
                        <label for="password" class="block mb-1 text-sm font-semibold text-primary">Password</label>

                        <div class="relative">
                            <input x-model="password" :type="show ? 'text' : 'password'" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                   focus:ring-primary focus:border-primary block w-full p-2.5 pr-10 outline-none"
                                placeholder="Masukkan password" required>

                            <!-- ICON MATA -->
                            <button type="button" @click="show = !show"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-primary">

                                <!-- Eye -->
                                <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
        c4.477 0 8.268 2.943 9.542 7
        -1.274 4.057-5.065 7-9.542 7
        -4.477 0-8.268-2.943-9.542-7z" />
                                </svg>

                                <!-- Eye Off -->
                                <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-width="2" d="M3 3l18 18" />
                                </svg>

                            </button>
                        </div>

                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- KONFIRMASI -->
                    <div class="mb-4">
                        <label for="password_confirmation"
                            class="block mb-1 text-sm font-semibold text-primary">Konfirmasi Password</label>
                        <div class="relative">
                            <input x-model="confirm" :type="showConfirm ? 'text' : 'password'"
                                name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-sm rounded-lg 
                   block w-full p-2.5 pr-10 focus:ring-primary focus:border-primary" placeholder="Ulangi password"
                                required>

                            <button type="button" @click="showConfirm = !showConfirm"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-primary">

                                <!-- Eye -->
                                <svg x-show="!showConfirm" x-cloak class="h-5 w-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                    c4.477 0 8.268 2.943 9.542 7
                    -1.274 4.057-5.065 7-9.542 7
                    -4.477 0-8.268-2.943-9.542-7z" />
                                </svg>

                                <!-- Eye Off -->
                                <svg x-show="showConfirm" x-cloak class="h-5 w-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-width="2" d="M3 3l18 18" />
                                    <path stroke-width="2" d="M10.584 10.587A3 3 0 0012 15
                    a3 3 0 002.12-.88" />
                                </svg>
                            </button>

                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>


                    <!-- VALIDASI PASSWORD -->
                    <div class="mt-3 space-y-1 text-xs">
                        <p :class="isMin ? 'text-green-600' : 'text-red-600'"
                            class="flex items-center transition-colors">
                            <i :class="isMin ? 'fa-check-circle' : 'fa-times-circle'" class="fas mr-2"></i> Min. 8 Karakter
                        </p>
                        <p :class="hasNumber ? 'text-green-600' : 'text-red-600'"
                            class="flex items-center transition-colors">
                            <i :class="hasNumber ? 'fa-check-circle' : 'fa-times-circle'" class="fas mr-2"></i> Harus
                            mengandung angka (0-9)
                        </p>
                        <p :class="isSame ? 'text-green-600' : 'text-red-600'"
                            class="flex items-center transition-colors">
                            <i :class="isSame ? 'fa-check-circle' : 'fa-times-circle'" class="fas mr-2"></i> Password
                            dan Konfirmasi harus sama
                        </p>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full text-white bg-gradient-to-r from-olivine to-primary  hover:bg-opacity-90 focus:ring-4 focus:outline-none focus:ring-olivine font-bold rounded-full text-md px-5 py-3 text-center transition-all transform active:scale-[0.98] shadow-md">
                        Daftar
                    </button>
                </div>


                <!-- LOGIN -->
                <div class="flex items-center justify-center mt-4">
                    <p class="text-sm text-gray-500">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-secondary hover:underline font-bold">
                            Login di sini
                        </a>
                    </p>
                </div>

            </form>
        </div>
    </div>

</x-guest-layout>