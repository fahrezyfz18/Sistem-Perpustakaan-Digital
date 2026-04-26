<aside class="w-64 h-screen bg-gray-800 text-white fixed">
    <div class="p-6 text-xl font-bold border-b border-gray-700">
        📚 User Panel
    </div>

    <nav class="p-4 space-y-2">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            🏠 Dashboard
        </a>

        <!-- Daftar Buku -->
        <a href="{{ route('books.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            📖 Melihat Daftar Buku
        </a>

        <!-- Filter Buku -->
        <a href="{{ route('books.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            🔍 Filter Buku
        </a>

        <!-- Peminjaman -->
        <a href="{{ route('borrow.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            📥 Peminjaman Buku
        </a>

        <!-- Status -->
        <a href="/history"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            📊 Status Peminjaman
        </a>

        <!-- Profil -->
        <a href="{{ route('profile.edit') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            ⚙️ Kelola Profil
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button class="w-full text-left px-4 py-2 bg-red-600 rounded hover:bg-red-700">
                🚪 Logout
            </button>
        </form>

    </nav>
</aside>