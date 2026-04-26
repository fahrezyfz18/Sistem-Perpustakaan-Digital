<aside class="w-64 h-screen bg-primary text-white fixed shadow-lg">

    <div class="p-6 text-xl font-bold border-b border-accent">
        📚 User Panel
    </div>

    <nav class="p-4 space-y-2 text-sm">

        <!-- Dashboard -->
        <a href="{{ route('user.dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-accent transition">
            🏠 Dashboard
        </a>

        <!-- Daftar Buku -->
        <a href="{{ route('user.books.index') }}"
           class="block px-4 py-2 rounded hover:bg-accent transition">
            📖 Melihat Daftar Buku
        </a>

        <!-- Filter Buku -->
        <a href="{{ route('user.books.filter') }}"
           class="block px-4 py-2 rounded hover:bg-accent transition">
            🔍 Filter Buku
        </a>

        <!-- Peminjaman -->
        <a href="{{ route('user.borrow.index') }}"
           class="block px-4 py-2 rounded hover:bg-accent transition">
            📥 Peminjaman Buku
        </a>

        <!-- Status -->
        <a href="{{ route('user.borrow.status') }}"
           class="block px-4 py-2 rounded hover:bg-accent transition">
            📊 Status Peminjaman
        </a>

        <!-- Profil -->
        <a href="{{ route('profile.edit') }}"
           class="block px-4 py-2 rounded hover:bg-accent transition">
            ⚙️ Kelola Profil
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button class="w-full text-left px-4 py-2 bg-secondary rounded hover:bg-camel transition">
                🚪 Logout
            </button>
        </form>

    </nav>
</aside>