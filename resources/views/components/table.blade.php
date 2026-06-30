@props([
    'headers' => [],
])

<div class="bg-white rounded-2xl shadow-sm border overflow-hidden flex flex-col">
    <div class="p-3 border-b bg-gray-50/50 flex justify-between items-center sm:hidden">
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Navigasi Data</span>
        <span class="text-[10px] bg-gray-200 text-gray-600 px-2 py-0.5 rounded animate-pulse">Geser Kesamping &rarr;</span>
    </div>

    <div class="overflow-x-auto whitespace-nowrap scrollbar-thin">
        <table class="w-full text-sm text-gray-700 table-auto">
            <thead class="bg-kombu text-white font-semibold">
                <tr>
                    @foreach($headers as $header)
                        <th class="px-6 py-4 text-center tracking-wide font-semibold text-sm">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>