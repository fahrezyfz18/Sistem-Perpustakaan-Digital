<aside class="w-64 h-screen bg-gray-800 text-white fixed">
    <div class="p-6 text-xl font-bold border-b border-gray-700">
        📚 Admin Panel
    </div>

    <nav class="p-4 space-y-2">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            🏠 Dashboard
        </a>

        <!-- Kelola Buku -->
        <a href="/admin/buku"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            📚 Kelola Data Buku
        </a>

        <!-- Kelola Anggota -->
        <a href="/admin/members"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            👥 Kelola Data Anggota
        </a>

        <!-- Pengembalian Buku -->
        <a href="/admin/return"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            🔄 Pengembalian Buku
        </a>

        <!-- Laporan -->
        <a href="/admin/reports"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            📊 Laporan Peminjaman
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