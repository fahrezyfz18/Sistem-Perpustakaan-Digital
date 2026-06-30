@props([
    'title',
    'subtitle' => null,
    'action' => null,
    'actionText' => '+ Tambah',
])

<div class="min-h-screen bg-background">
    <div class="max-w-7xl mx-auto p-4 sm:p-6 space-y-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-2">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-kombu tracking-tight">
                    {{ $title }}
                </h1>
                @if($subtitle)
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $subtitle }}
                    </p>
                @endif
            </div>

            <div class="flex flex-wrap items-center gap-2">
                {{-- Custom Action Slot (Jika ada tombol tambahan seperti Export/Filter) --}}
                @if(isset($headerActions))
                    {{ $headerActions }}
                @endif

                {{-- Default Action Button --}}
                @if($action)
                    <a href="{{ $action }}"
                       class="inline-flex items-center justify-center bg-secondary hover:bg-opacity-90 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition-all whitespace-nowrap">
                        {{ $actionText }}
                    </a>
                @endif
            </div>
        </div>

        <div class="w-full">
            {{ $slot }}
        </div>

    </div>
</div>