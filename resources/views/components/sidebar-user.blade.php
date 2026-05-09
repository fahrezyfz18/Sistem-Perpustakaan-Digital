<!-- USER SIDEBAR -->
<aside class="fixed z-40 w-64 h-screen font-sans text-white shadow-xl bg-primary
           transform transition-transform duration-300
           -translate-x-full md:translate-x-0"
    :class="{ 'translate-x-0': sidebarOpen }">

    <!-- LOGO / TITLE -->
    <div class="flex items-center h-16 px-4 border-b border-accent/30">

        <div class="flex items-center justify-center w-full h-full">

            <img src="{{ asset('images/LOGO_LS_TRANSPARAN.png') }}"
                 alt="LeafShelf Logo"

                 class="h-full max-h-[56px] w-auto object-contain
                        brightness-125 contrast-110
                        drop-shadow-[0_2px_6px_rgba(0,0,0,0.5)]
                        drop-shadow-[0_0_6px_rgba(255,255,255,0.15)]
                        transition duration-300" />

        </div>

    </div>

    <!-- MENU -->
    <nav class="p-4 space-y-2 text-sm overflow-y-auto h-[calc(100%-4rem)]">

        <!-- DASHBOARD -->
        <a href="{{ route('user.dashboard') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  hover:bg-accent/40 hover:pl-5">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 12l2-2 7-7 7 7 2 2M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3" />

            </svg>

            Dashboard

        </a>

        <!-- DAFTAR BUKU -->
        <a href="{{ route('user.books.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  hover:bg-accent/40 hover:pl-5">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 6.253v13m0-13C10.832 5.483 9.246 5
                         7.5 5 4.462 5 2 6.567 2 8.5v10
                         C2 16.567 4.462 15 7.5 15c1.746 0
                         3.332.483 4.5 1.253m0-13
                         C13.168 5.483 14.754 5 16.5 5
                         c3.038 0 5.5 1.567 5.5 3.5v10
                         c0-1.933-2.462-3.5-5.5-3.5
                         -1.746 0-3.332.483-4.5 1.253" />

            </svg>

            Daftar Buku

        </a>

        <!-- RIWAYAT PEMINJAMAN -->
        <a href="{{ route('user.history.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  hover:bg-accent/40 hover:pl-5">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0
                         11-18 0 9 9 0 0118 0z" />

            </svg>

            Riwayat Peminjaman

        </a>

        <!-- BUKU SAYA -->
        <a href="{{ route('user.my-books.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  hover:bg-accent/40 hover:pl-5">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5 4v16l7-5 7 5V4z" />

            </svg>

            Buku Saya

        </a>

        <!-- PENGATURAN -->
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  hover:bg-accent/40 hover:pl-5">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M10.325 4.317a1.724 1.724 0 013.35 0
                         1.724 1.724 0 002.573 1.066
                         1.724 1.724 0 012.37 2.37
                         1.724 1.724 0 001.065 2.572
                         1.724 1.724 0 010 3.35
                         1.724 1.724 0 00-1.066 2.573
                         1.724 1.724 0 01-2.37 2.37
                         1.724 1.724 0 00-2.572 1.065
                         1.724 1.724 0 01-3.35 0
                         1.724 1.724 0 00-2.573-1.066
                         1.724 1.724 0 01-2.37-2.37
                         1.724 1.724 0 00-1.065-2.572
                         1.724 1.724 0 010-3.35
                         1.724 1.724 0 001.066-2.573
                         1.724 1.724 0 012.37-2.37
                         1.724 1.724 0 002.572-1.065z" />

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 12a3 3 0 11-6 0
                         3 3 0 016 0z" />

            </svg>

            Pengaturan

        </a>

        <!-- LOGOUT -->
        <form method="POST"
              action="{{ route('logout') }}"
              class="pt-6 mt-4 border-t border-accent/30">

            @csrf

            <button
                class="flex items-center w-full gap-3 px-4 py-2 transition rounded-lg
                       bg-secondary hover:bg-camel hover:pl-5">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7" />

                </svg>

                Logout

            </button>

        </form>

    </nav>

</aside>