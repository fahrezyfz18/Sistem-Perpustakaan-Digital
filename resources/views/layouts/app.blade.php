<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LeafShelf') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-background text-gray-800">

    <div x-data="{ sidebarOpen: false, logoutModalOpen: false }" class="flex min-h-screen overflow-x-hidden">

        @auth
            @if(auth()->user()->role === 'admin')
                @include('components.sidebar-admin')
            @else
                @include('components.sidebar-user')
            @endif
        @endauth

        <div x-show="sidebarOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false" 
             class="fixed inset-0 bg-black/50 z-30 md:hidden"></div>

        <div class="flex-1 min-w-0 md:ml-64 flex flex-col min-h-screen">

            @include('layouts.navigation')

            <main class="flex-1 p-4 md:p-6 container mx-auto">
                @yield('content')
            </main>

        </div>

        <div x-show="logoutModalOpen" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto"
             x-cloak>
            
            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" @click="logoutModalOpen = false"></div>

            <div x-show="logoutModalOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative bg-white rounded-2xl shadow-xl max-w-md w-full p-6 transform transition-all z-10 text-center">
                
                <div class="w-12 h-12 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>

                <h3 class="text-lg font-bold text-kombu mb-2">Konfirmasi Keluar</h3>
                <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin mengakhiri sesi ini dari LeafShelf?</p>

                <div class="flex items-center justify-center gap-3">
                    <button type="button" @click="logoutModalOpen = false"
                            class="px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors w-28 focus:outline-none">
                        Batal
                    </button>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-xl transition-colors w-28 shadow-md shadow-red-600/10 focus:outline-none">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>
</html>