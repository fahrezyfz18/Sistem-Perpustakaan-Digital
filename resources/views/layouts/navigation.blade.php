<nav x-data="{ open: false }" class="bg-white border-b border-kombu shadow-sm">

    <div class="w-full px-6">
        <div class="flex justify-between h-16 items-center">

            <!-- LEFT -->
            <div class="flex items-center gap-3">

                <!-- TOGGLE BUTTON (MOBILE) -->
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-kombu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <span class="text-kombu font-bold text-lg">
                    {{ config('app.name', 'Leafshelf') }}
                </span>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-4">

                <!-- NOTIFIKASI -->
                <button class="relative text-kombu hover:text-mustard transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0m6 0H9" />
                    </svg>

                    <!-- badge -->
                    <span
                        class="absolute -top-1 -right-1 bg-mustard text-white text-xs w-4 h-4 flex items-center justify-center rounded-full">
                        3
                    </span>
                </button>

                <!-- PROFILE -->
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button
                            class="flex items-center gap-2 text-sm font-medium text-kombu hover:text-mustard transition">

                            <div class="w-8 h-8 bg-kombu text-white rounded-full flex items-center justify-center">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <span>{{ Auth::user()->name }}</span>

                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>

                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('admin.profile.index')" class="{{ request()->routeIs('admin.profile.*')
    ? 'text-camel bg-olivine/10'
    : 'text-kombu hover:text-mustard hover:bg-olivine/10' }}">
                            Profile
                        </x-dropdown-link>


                    </x-slot>

                </x-dropdown>

                <!-- MOBILE MENU -->
                <button @click="open = ! open" class="sm:hidden text-kombu">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'block': ! open}" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{'hidden': ! open, 'block': open}" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>

            </div>
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-200">

        <div class="px-4 py-3 text-sm text-kombu">
            {{ Auth::user()->name }}
        </div>

        <div class="px-4 pb-3">
            <x-responsive-nav-link :href="route('profile.edit')">
                Profile
            </x-responsive-nav-link>
        </div>

    </div>

</nav>