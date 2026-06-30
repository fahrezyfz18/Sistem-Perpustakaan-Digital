@props([
    'action',
    'placeholder' => 'Cari data...',
    'categories' => []
])

<div class="bg-white rounded-2xl shadow-sm border p-4 mb-6">
    <form id="search-form" method="GET" action="{{ $action }}"
          class="grid grid-cols-1 {{ !empty($categories) && count($categories) ? 'md:grid-cols-4' : 'md:grid-cols-1' }} gap-3">

        <div class="{{ !empty($categories) && count($categories) ? 'md:col-span-3' : 'md:col-span-1' }} relative">
            <input
                type="text"
                id="searchInput"
                name="search"
                value="{{ request('search') }}"
                placeholder="{{ $placeholder }}"
                autocomplete="off"
                class="w-full border border-gray-200 focus:border-kombu focus:ring-2 focus:ring-kombu/20 outline-none rounded-xl py-2.5 pl-10 pr-4 text-sm text-gray-700 transition-all placeholder-gray-400"
            >
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z"/>
                </svg>
            </div>
        </div>

        @if(!empty($categories) && count($categories))
            <div>
                <select
                    id="categorySelect"
                    name="category"
                    class="w-full border border-gray-200 focus:border-kombu focus:ring-2 focus:ring-kombu/20 outline-none rounded-xl px-4 py-2.5 text-sm text-gray-600 bg-white transition-all appearance-none cursor-pointer"
                >
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->nama ?? $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('search-form');
        const search = document.getElementById('searchInput');
        const category = document.getElementById('categorySelect');
        let timer;

        // Debounce Realtime Search (500 ms)
        if (search) {
            search.addEventListener('keyup', function () {
                clearTimeout(timer);
                timer = setTimeout(function () {
                    form.submit();
                }, 500);
            });
        }

        // Otomatis Submit saat Kategori Berubah
        if (category) {
            category.addEventListener('change', function () {
                form.submit();
            });
        }
    });
</script>