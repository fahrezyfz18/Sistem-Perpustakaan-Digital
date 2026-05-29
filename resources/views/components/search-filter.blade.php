<div class="bg-white rounded-xl shadow p-4 mb-6">

    <form method="GET"
        action="{{ $action }}"
        class="grid grid-cols-1 md:grid-cols-4 gap-3">

        <!-- SEARCH -->
        <div class="md:col-span-2 relative">

            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="{{ $placeholder }}"
                class="w-full border border-gray-300 rounded-lg
                       py-2 pl-10 pr-4
                       focus:ring-2 focus:ring-primary
                       focus:border-primary outline-none">

            <!-- ICON -->
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                <svg class="w-5 h-5 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z" />

                </svg>

            </div>

        </div>

        <!-- CATEGORY -->
        <div>

            <select name="kategori"
                class="w-full border border-gray-300 rounded-lg
                       px-4 py-2
                       focus:ring-2 focus:ring-primary
                       focus:border-primary outline-none">

                <option value="">Semua Kategori</option>

                @foreach($categories as $category)

                    <option value="{{ $category }}"
                        {{ request('kategori') == $category ? 'selected' : '' }}>

                        {{ $category }}

                    </option>

                @endforeach

            </select>

        </div>

        <!-- BUTTON -->
        <div>

            <button type="submit"
                class="w-full bg-secondary hover:bg-camel
                       text-white px-4 py-2 rounded-lg transition">

                Cari

            </button>

        </div>

    </form>

</div>