<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center px-4 py-16 bg-asparagus/50">
        <div class="w-full max-w-md bg-white backdrop-blur-sm rounded-2xl shadow-xl p-8 border-t-4 border-primary">

            <!-- Logo -->
            <div class="text-center mb-6">
                <img src="{{ asset('images/LOGO_LS_TRANSPARAN.png') }}" class="h-16 mx-auto mb-4" alt="LeafShelf Logo">
                <h2 class="text-2xl font-bold text-primary">Login</h2>
                <p class="text-xs text-gray-500 italic">
                    Kembali dan lanjutkan pertumbuhanmu.
                </p>
            </div>


            <!-- GLOBAL ERROR -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-600 text-sm p-3 rounded-lg mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label class="text-sm font-semibold text-primary">Email</label>
                    <input type="email" name="email"
                        class="w-full mt-1 p-2.5 border rounded-lg bg-gray-50 focus:ring-primary focus:border-primary">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Password -->
                <div x-data="{ show: false }">
                    <label class="text-sm font-semibold text-primary">Password</label>

                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="password"
                            class="w-full mt-1 p-2.5 border rounded-lg bg-gray-50 focus:ring-primary focus:border-primary pr-10">

                        <!-- show or hide password -->
                        <button type="button" @click="show = !show"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-camel-500 hover:text-primary">

                            <!-- show password icon -->
                            <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <!-- eye icon -->
                                <path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                <!-- eye off icon -->
                                <path stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <!-- show password icon -->
                            <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <!-- eye icon -->
                                <path stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7" />
                            </svg>

                        </button>
                    </div>

                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember + Forgot -->
                <div class="flex justify-between items-center text-sm">
                    <label class="flex items-center text-gray-600">
                        <input type="checkbox" class="mr-2">
                        Ingat saya
                    </label>

                    <a href="#" class="text-secondary hover:underline font-semibold">
                        Lupa Password?
                    </a>
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-olivine to-primary text-white py-3 rounded-full font-bold shadow-md">
                    Login
                </button>


                <!-- REGISTER -->
                <p class="text-center text-sm text-gray-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-secondary font-bold">Daftar</a>
                </p>

            </form>

        </div>
    </div>

</x-guest-layout>