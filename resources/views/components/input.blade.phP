@props(['label'])

<div class="mb-4">
    <label class="text-sm text-gray-600">
        {{ $label }}
    </label>

    <div class="mt-1">
        {{ $slot }}
    </div>
</div>