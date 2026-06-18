@props([
    'align' => 'right',
    'width' => '48',
    'contentClasses' => 'py-1 bg-white'
])

@php
$alignmentClasses = match ($align) {
    'left' => 'origin-top-left start-0',
    'top' => 'origin-top',
    default => 'origin-top-right end-0',
};

$width = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

<div class="relative" x-data="{ open: false }"
     @click.outside="open = false">

    <!-- TRIGGER -->
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <!-- CONTENT -->
    <div x-show="open"
         x-transition
         class="absolute z-50 mt-2 {{ $width }} rounded-xl shadow-lg {{ $alignmentClasses }}"
         style="display: none;"
         @click="open = false">

        <div class="rounded-xl ring-1 ring-kombu/10 bg-white overflow-hidden">

            {{ $content }}

        </div>

    </div>
</div>