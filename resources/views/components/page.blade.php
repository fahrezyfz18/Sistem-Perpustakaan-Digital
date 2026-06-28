@props([
'title',
'subtitle' => null,
'action' => null,
'actionText' => '+ Tambah'
])

<!-- WRAPPER -->
<div class="p-6 bg-background h-full">

    <!-- HEADER -->
    <div class="mb-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <!-- TITLE -->
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

            <!-- ACTION AREA -->
            <div class="flex flex-wrap items-center gap-2">

                {{-- Custom Action Slot --}}
                {{ $headerActions ?? '' }}

                {{-- Default Action --}}
                @if($action)
                <a href="{{ $action }}"
                    class="inline-flex items-center justify-center
                               bg-secondary text-white px-4 py-2 rounded-lg
                               hover:bg-camel transition whitespace-nowrap">
                    {{ $actionText }}
                </a>
                @endif

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div>
        {{ $slot }}
    </div>

</div>